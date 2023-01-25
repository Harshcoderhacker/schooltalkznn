<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Assignsubject;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Material\Material;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Assignsubjectliverwire extends Component
{
    use WithPagination;

    public $classmaster, $section, $staff, $staffdata;
    public $classmasterid, $sectionid, $staffid = '';
    public $isactive = false;
    public $is_classteacher = false;
    public $is_classteacheralreadyasign = false;

    public $isshowmodalopen = false;
    public $iseditmodalopen = false;

    public $assignsubjecteditdata;
    public $assignsubjectshowdata;

    public $classmasterobj;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();

        $this->section = [];
    }

    public function assignsubjectshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function assignsubjectclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->assignsubjectshowdata = [];
    }

    public function assignsubjecteditshowmodal()
    {
        $this->iseditmodalopen = true;
    }
    public function assignsubjecteditclosemodal()
    {
        $this->iseditmodalopen = false;
        $this->assignsubjecteditdata = [];
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->classmasterobj = Classmaster::find($this->classmasterid);
            $this->section = $this->classmasterobj->section;
        } else {
            $this->section = [];
        }
    }

    public function show(Assignsubject $assignsubject)
    {
        $this->assignsubjectshowdata = $assignsubject;
        $this->assignsubjectshowmodal();
    }

    public function edit(Assignsubject $assignsubject)
    {
        $this->assignsubjecteditdata = $assignsubject;
        $this->isactive = $assignsubject->active;
        $this->staffid = $assignsubject->staff_id;
        $this->is_classteacher = $assignsubject->is_classteacher;
        $this->is_classteacheralreadyasign = Assignsubject::where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->where('is_classteacher', true)
            ->first();

        $this->assignsubjecteditshowmodal();
    }

    public function update(Assignsubject $assignsubject)
    {

        try {
            DB::beginTransaction();
            $assignsubject->staff_id = $this->staffid;
            $assignsubject->active = $this->isactive;
            $assignsubject->is_classteacher = $this->is_classteacher;
            $assignsubject->save();

            $assignsubject->chatgroup
                ->where('chattype', 2)
                ->first()
                ->update(['staff_id', $this->staffid]);

            Helper::trackmessage(auth()->user(), 'Admin Assignsubject Updated', 'admin_web_assignsubject_update', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Assign Teacher Updated Successfully!']);
            $this->assignsubjecteditclosemodal();

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function render()
    {

        DB::beginTransaction();

        $assignsubject = $this->assignsubjectandchat();
        $this->studentmaterials();

        DB::commit();
        $subject = Subject::where('active', true)->get();
        $this->staff = Staff::where('active', true)->get();

        return view('livewire.admin.settings.academicsettings.assignsubject.assignsubjectliverwire',
            compact('assignsubject', 'subject'));
    }

    protected function studentmaterials()
    {
        if ($this->classmasterid && $this->sectionid) {
            $subject = Subject::where('active', true)
                ->whereDoesntHave('material', fn(Builder $query) =>
                    $query->where('classmaster_id', $this->classmasterid)
                )->get();

            foreach ($subject as $eachsubject) {

                if (Material::where('classmaster_id', $this->classmasterid)->count() == 0) {
                    Material::create([
                        'classmaster_id' => $this->classmasterid,
                        'material_type' => 3,
                    ]);
                }
                Material::create([
                    'classmaster_id' => $this->classmasterid,
                    'subject_id' => $eachsubject->id,
                    'material_type' => 1,
                ]);
                Material::create([
                    'classmaster_id' => $this->classmasterid,
                    'subject_id' => $eachsubject->id,
                    'material_type' => 2,
                ]);
            }
        }
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_assignsubject_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    protected function assignsubjectandchat()
    {
        if ($this->classmasterid && $this->sectionid) {

            $subject = Subject::where('active', true)
                ->whereDoesntHave('assignsubject', fn(Builder $query) =>
                    $query->where('classmaster_id', $this->classmasterid)
                        ->where('section_id', $this->sectionid)
                )->get();

            $sectionname = Section::find($this->sectionid)->name;

            foreach ($subject as $eachsubject) {

                $assignsubject = Assignsubject::create([
                    'classmaster_id' => $this->classmasterid,
                    'section_id' => $this->sectionid,
                    'subject_id' => $eachsubject->id,
                ]);

                if (Chatgroup::where('classmaster_id', $this->classmasterid)->where('section_id', $this->sectionid)->count() == 0) {
                    $assignsubject->chatgroup()->create([
                        'classmaster_id' => $this->classmasterid,
                        'section_id' => $this->sectionid,
                        'groupname' => $this->classmasterobj->name . '-' . $sectionname . ' Class Group',
                        'shortname' => 'Class Group',
                        'chattype' => 1, // CLASSGROUP
                    ]);
                }

                $assignsubject->chatgroup()->create([
                    'classmaster_id' => $this->classmasterid,
                    'section_id' => $this->sectionid,
                    'subject_id' => $eachsubject->id,
                    'groupname' => $this->classmasterobj->name . '-' . $sectionname . ' ' . $eachsubject->name . ' Group',
                    'shortname' => $eachsubject->name . ' Group',
                    'chattype' => 2, // SUBJECTGROUP
                ]);

            }

            return Assignsubject::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();

        } else {
            return [];
        }
    }
}
