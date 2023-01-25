<?php

namespace App\Http\Livewire\Admin\Settings\Examsettings\Examgrade;

use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Examgradelivewire extends Component
{
    use WithPagination;

    public $gradeid, $name, $percentage_from, $percentage_to;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $gradebtn = true;

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:examgrades,name,' . $this->gradeid,
            'percentage_from' => 'required|numeric|unique:examgrades,percentage_from,' . $this->gradeid,
            'percentage_to' => 'required|numeric|unique:examgrades,percentage_to,' . $this->gradeid . ',|gt:' . $this->percentage_from,
        ];
    }

    public function updated($propertyName)
    {
        $this->gradebtn = true;
        $this->validateOnly($propertyName);
        $this->gradebtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();

            $user = auth()->user();

            if ($this->gradeid) {
                $grademodel = Examgrade::find($this->gradeid);

                $grademodel->name = $this->name;
                $grademodel->percentage_from = $this->percentage_from;
                $grademodel->percentage_to = $this->percentage_to;

                if ($grademodel->isDirty()) {
                    $grademodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Exam Grade Update', 'admin_web_exam_grade_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Exam Grade Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                }

            } else {
                Examgrade::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Exam Grade Create', 'admin_web_exam_grade_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Exam Grade Added Successfully!']);
            }
            $this->gradebtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }
    public function edit(Examgrade $examgrade)
    {
        $this->name = $examgrade->name;
        $this->percentage_from = $examgrade->percentage_from;
        $this->percentage_to = $examgrade->percentage_to;
        $this->gradeid = $examgrade->id;
    }

    public function deleteconfirm($gradeid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['gradeid' => $gradeid]);
    }

    public function delete(Examgrade $examgrade)
    {

        try {
            DB::beginTransaction();

            $examgrade->delete();
            Helper::trackmessage(auth()->user(), 'Admin Exam Grade Delete', 'admin_web_exam_grade_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Exam Grade Deleted!']);

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
        $this->percentage_from = null;
        $this->percentage_to = null;
        $this->gradeid = null;
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
        $examgrade = Examgrade::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.examsettings.examgrade.examgradelivewire', compact('examgrade'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_feediscount_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
