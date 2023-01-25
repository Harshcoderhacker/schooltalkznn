<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Timetable;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;

class Timetablelivewire extends Component
{
    use LivewireAlert;

    public $classmasterid, $sectionid, $assignsubjectid, $timetableid, $classroutineid;

    public $classmaster, $section;

    public $day;

    public $timetable, $allassignsubject;

    public $isModalOpen = false;

    public $timetableobj, $classroutineobj;

    protected function rules()
    {
        return [
            'assignsubjectid' => 'required|integer',
        ];
    }

    protected $messages = [
        'assignsubjectid.required' => 'Required',
        'assignsubjectid.integer' => 'Required',
    ];

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
    }

    public function timetableopenmodal($day, Classroutine $classroutineobj, Timetable $timetableobj)
    {
        $this->timetableobj = $timetableobj;
        $this->classroutineobj = $classroutineobj; // Periodid
        $this->day = $day;
        $this->isModalOpen = true;
    }

    public function edit(Timetable $timetableobj, $assignsubjectid, $day)
    {
        $this->timetableobj = $timetableobj;
        $this->classroutineobj = Classroutine::find($timetableobj->classroutine_id);
        $this->assignsubjectid = $assignsubjectid;
        $this->day = $day;
        $this->isModalOpen = true;
    }

    public function timetableclosemodal()
    {
        $this->resetErrorBag();
        $this->assignsubjectid = "";
        $this->isModalOpen = false;
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function updatetimetable()
    {
        $validated = $this->validate();
        try {
            DB::beginTransaction();
            if ($this->assignsubjectid) {
                $assingsubject = Assignsubject::find($this->assignsubjectid);

                if ($assingsubject->staff) {
                    $assingedclassstaff = Stafftimetable::where('staff_id', $assingsubject->staff->id)
                        ->where('classroutine_id', $this->classroutineobj->id)
                        ->whereNotNull($this->day)
                        ->pluck($this->day);

                    if (count($assingedclassstaff) > 0) {
                        $classnameandsection = Assignsubject::find($assingedclassstaff[0]);
                        $msg = "Teacher already assinged to" . $classnameandsection->classmaster->name . ' ' . $classnameandsection->section->name . ' Sec';
                        $this->alert('warning', $msg, [
                            'position' => 'top-end',
                            'timer' => '5000',
                            'toast' => true,
                            'timerProgressBar' => true,
                        ]);
                    } else {
                        Timetable::find($this->timetableobj->id)
                            ->update([
                                $this->day => $this->assignsubjectid,
                            ]);
                        Stafftimetable::where('classroutine_id', $this->classroutineobj->id)
                            ->where('staff_id', $assingsubject->staff->id)
                            ->update([
                                $this->day => $this->assignsubjectid,
                            ]);
                        $this->timetableclosemodal();
                        $this->dispatchBrowserEvent('successtoast', ['message' => "Time Table Updated Successfully!"]);
                        DB::commit();
                        Helper::trackmessage(auth()->user(), 'Admin Time Table Added', 'admin_web_timetable_added', session()->getId(), 'WEB');
                    }
                } else {
                    $this->dispatchBrowserEvent('warningtoast', ['message' => "No Staff Assigned"]);
                }
            }
        } catch (Exception $e) {
            $this->exceptionerror('added', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('added', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('added', 'three', $e);
        }
    }

    public function deleteconfirm($classroutineid, $day)
    {
        $this->dispatchBrowserEvent('deletetoast', ['classroutineid' => $classroutineid . '-' . $day]);
    }

    public function delete($classroutine, $day)
    {
        try {
            DB::beginTransaction();

            $classroutineid = Classroutine::where('uuid', $classroutine)->first()->id;

            $classmastersectionid = ClassmasterSection::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->first()
                ->id;

            $timetableassingid = Timetable::where('classroutine_id', $classroutineid)
                ->where('classmaster_section_id', $classmastersectionid)
                ->first()
                ->$day;

            Stafftimetable::where('classroutine_id', $classroutineid)
                ->where('staff_id', Assignsubject::find($timetableassingid)->staff->id)
                ->update([
                    $day => null,
                ]);

            Timetable::where('classroutine_id', $classroutineid)
                ->where('classmaster_section_id', $classmastersectionid)
                ->update([
                    $day => null,
                ]);

            Helper::trackmessage(auth()->user(), 'Admin Time Table Delete', 'admin_web_timetable_delete', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Time Table Deleted!']);
        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function updatedSectionid()
    {
        try {
            if ($this->sectionid != 0) {
                DB::beginTransaction();
                ClassmasterSection::where('classmaster_id', $this->classmasterid)
                    ->where('section_id', $this->sectionid)
                    ->first()
                    ->classroutine()
                    ->sync(Classroutine::where('active', true)
                            ->pluck('id'));

                foreach (Weekend::where('active', true)
                    ->where('is_holiday', true)
                    ->pluck('name') as $weekendeach) {

                    Timetable::where('classmaster_section_id', ClassmasterSection::where('classmaster_id', $this->classmasterid)
                            ->where('section_id', $this->sectionid)
                            ->first()->id)
                        ->update([strtolower($weekendeach) => 0]);
                }
                DB::commit();
            }
        } catch (Exception $e) {
            $this->exceptionerror('updatedSectionid', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('updatedSectionid', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('updatedSectionid', 'three', $e);
        }
    }

    public function render()
    {
        if ($this->classmasterid && $this->sectionid) {
            $this->timetable = Timetable::where('classmaster_section_id', ClassmasterSection::where('classmaster_id', $this->classmasterid)
                    ->where('section_id', $this->sectionid)
                    ->first()->id)
                ->whereHas('classroutine', fn(Builder $q) => $q->where('is_break', false))
                ->get();

            $this->allassignsubject = Assignsubject::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();
        }

        return view('livewire.admin.settings.academicsettings.timetable.timetablelivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_classroutine_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
