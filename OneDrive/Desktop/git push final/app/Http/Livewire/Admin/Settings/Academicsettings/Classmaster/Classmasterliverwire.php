<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Classmaster;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Classmasterliverwire extends Component
{
    use WithPagination;

    public $classmasterid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $section, $sectionid;

    public $sectionchecked = true;
    public $sectionunchecked = false;

    public $selectedSection = [];

    public $isModalFormOpen = false;

    public $classmastershowdata;

    public $isshowmodalopen = false;

    public function classmastershowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function classmasterclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->classmastershowdata = [];
    }

    public function mount()
    {
        $this->section = Section::where('active', true)->get();
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:classmasters,name,' . $this->classmasterid,
        ];
    }

    public function updated($propertyName)
    {

        $this->validateOnly($propertyName);

    }

    public function confrimclassopenformModal()
    {
        $this->isModalFormOpen = true;
    }
    public function confrimclasscloseFormModal()
    {
        $this->isModalFormOpen = false;
        $this->selectedSection = [];
        $this->formreset();
        $this->resetPage();
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->classmasterid) {
                $classmastermodel = Classmaster::find($this->classmasterid);

                $classmastermodel->name = $this->name;

                if ($classmastermodel->isDirty() || count($this->selectedSection)) {

                    $classmastermodel->save();

                    $collection = collect();
                    foreach ($this->selectedSection as $value) {
                        $collection->put($value, ['uuid' => Str::uuid()]);
                    }
                    $classmastermodel->section()->attach($collection);
                    $this->sectionchecked = false;
                    $this->selectedSection = [];

                    Helper::trackmessage(auth()->user(), 'Admin Classmaster Update', 'admin_web_classmaster_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Classmaster Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('classmaster_field_focus_trigger');
                }
            } else {
                $collection = collect();
                foreach ($this->selectedSection as $value) {
                    $collection->put($value, ['uuid' => Str::uuid()]);
                }

                Classmaster::create($validated)->section()->sync($collection);

                $classmaster_id = Classmaster::latest()->first()->id;
                Mapclass::create(['classmaster_id' => $classmaster_id]);
                $this->sectionchecked = false;
                $this->selectedSection = [];

                Helper::trackmessage(auth()->user(), 'Admin Classmaster Create', 'admin_web_classmaster_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Classmaster Added Successfully!']);
            }

            $this->confrimclasscloseFormModal();

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Classmaster $classmaster)
    {
        $this->classmastershowdata = $classmaster;
        $this->classmastershowmodal();
    }

    public function edit(Classmaster $classmaster)
    {
        $this->name = $classmaster->name;
        $this->classmasterid = $classmaster->id;
        $this->sectionid = $classmaster->section->pluck('id');
        $this->sectionchecked = true;
        $this->selectedSection = [];
        $this->emit('classmaster_field_focus_trigger');
    }

    public function submitclass()
    {
        $validated = $this->validate();

    }

    public function deleteconfirm($classmasterid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['classmasterid' => $classmasterid]);
    }

    public function delete(Classmaster $classmaster)
    {

        try {
            DB::beginTransaction();
            Mapclass::where('classmaster_id', $classmaster->id)->delete();
            $classmaster->delete();
            Helper::trackmessage(auth()->user(), 'Admin Classmaster Delete', 'admin_web_classmaster_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Classmaster Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    protected function formreset()
    {
        $this->name = null;
        $this->classmasterid = null;
    }

    public function formcancel()
    {
        $this->selectedSection = [];
        $this->formreset();
        $this->resetPage();
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $classmaster = Classmaster::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.academicsettings.classmaster.classmasterliverwire',
            compact('classmaster'));

    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_classmaster_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
