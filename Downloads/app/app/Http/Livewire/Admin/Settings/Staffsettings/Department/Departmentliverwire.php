<?php

namespace App\Http\Livewire\Admin\Settings\Staffsettings\Department;

use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Departmentliverwire extends Component
{
    use WithPagination;

    public $staffdepartmentid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $departmentsubmitbtn = true;

    public $departmentshowdata;

    public $isshowmodalopen = false;

    public function departmentshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function departmentclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->departmentshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:staffdepartments,name,' . $this->staffdepartmentid,
        ];
    }

    public function updated($propertyName)
    {
        $this->departmentsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->departmentsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->staffdepartmentid) {
                $staffdepartmentmodel = Staffdepartment::find($this->staffdepartmentid);

                $staffdepartmentmodel->name = $this->name;

                if ($staffdepartmentmodel->isDirty()) {
                    $staffdepartmentmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Staffdepartment Update', 'admin_web_staffdepartment_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Staff Department Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('staffdepartment_field_focus_trigger');
                }

            } else {
                Staffdepartment::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Staffdepartment Create', 'admin_web_staffdepartment_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Department Added Successfully!']);
            }
            $this->departmentsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Staffdepartment $staffdepartment)
    {
        $this->departmentshowdata = $staffdepartment;
        $this->departmentshowmodal();
    }

    public function edit(Staffdepartment $staffdepartment)
    {
        $this->name = $staffdepartment->name;
        $this->staffdepartmentid = $staffdepartment->id;
        $this->emit('staffdepartment_field_focus_trigger');
    }

    public function deleteconfirm($staffdepartmentid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['staffdepartmentid' => $staffdepartmentid]);
    }

    public function delete(Staffdepartment $staffdepartment)
    {
        try {
            DB::beginTransaction();

            $staffdepartment->delete();
            Helper::trackmessage(auth()->user(), 'Admin Staff Department Delete', 'admin_web_staffdepartment_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Staffdepartment Deleted!']);

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
        $this->staffdepartmentid = null;
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
        $staffdepartment = Staffdepartment::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.staffsettings.department.departmentliverwire', compact('staffdepartment'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_staffdepartment_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
