<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Section;

use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Sectionlivewire extends Component
{

    use WithPagination;

    public $sectionid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $sectionshowdata;

    public $sectionsubmitbtn = true;
    public $isshowmodalopen = false;

    public function sectionshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function sectionclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->sectionshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:sections,name,' . $this->sectionid,
        ];
    }

    public function updated($propertyName)
    {
        $this->sectionsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->sectionsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->sectionid) {
                $sectionmodel = Section::find($this->sectionid);

                $sectionmodel->name = $this->name;

                if ($sectionmodel->isDirty()) {
                    $sectionmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Section Update', 'admin_web_section_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Section Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('section_field_focus_trigger');
                }
            } else {
                Section::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Section Create', 'admin_web_section_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Section Added Successfully!']);
            }

            $this->sectionsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Section $section)
    {
        $this->sectionshowdata = $section;
        $this->sectionshowmodal();
    }

    public function edit(Section $section)
    {
        $this->name = $section->name;
        $this->sectionid = $section->id;
        $this->emit('section_field_focus_trigger');
    }

    public function deleteconfirm($sectionid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['sectionid' => $sectionid]);
    }

    public function delete(Section $section)
    {

        try {
            DB::beginTransaction();

            $section->delete();
            Helper::trackmessage(auth()->user(), 'Admin Section Delete', 'admin_web_section_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Section Deleted!']);

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
        $this->sectionid = null;
    }

    public function formcancel()
    {
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
        $section = Section::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.academicsettings.section.sectionlivewire', compact('section'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
