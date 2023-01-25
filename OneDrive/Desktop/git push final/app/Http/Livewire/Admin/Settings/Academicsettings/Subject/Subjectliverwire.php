<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Subject;

use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Subjectliverwire extends Component
{
    use WithPagination;

    public $subjectid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $subjectsubmitbtn = true;

    public $subjectshowdata;

    public $isshowmodalopen = false;

    public function subjectshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function subjectclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->subjectshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:subjects,name,' . $this->subjectid,
        ];
    }

    public function updated($propertyName)
    {
        $this->subjectsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->subjectsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->subjectid) {
                $subjectmodel = Subject::find($this->subjectid);

                $subjectmodel->name = $this->name;

                if ($subjectmodel->isDirty()) {
                    $subjectmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Subject Update', 'admin_web_subject_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Subject Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('subject_field_focus_trigger');
                }

            } else {
                $subject_id = Subject::create($validated)->id;
                Mapsubject::create(['subject_id' => $subject_id]);
                Helper::trackmessage(auth()->user(), 'Admin Subject Create', 'admin_web_subject_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Subject Added Successfully!']);
            }
            $this->subjectsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Subject $subject)
    {
        $this->subjectshowdata = $subject;
        $this->subjectshowmodal();
    }

    public function edit(Subject $subject)
    {
        $this->name = $subject->name;
        $this->subjectid = $subject->id;
        $this->emit('subject_field_focus_trigger');
    }

    public function deleteconfirm($subjectid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['subjectid' => $subjectid]);
    }

    public function delete(Subject $subject)
    {

        try {
            DB::beginTransaction();
            Mapsubject::where('subject_id', $subject->id)->delete();
            $subject->delete();
            Helper::trackmessage(auth()->user(), 'Admin Subject Delete', 'admin_web_subject_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Subject Deleted!']);

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
        $this->subjectid = null;
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
        $subject = Subject::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.academicsettings.subject.subjectliverwire', compact('subject'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_subject_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
