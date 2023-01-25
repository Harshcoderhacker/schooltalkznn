<?php

namespace App\Http\Livewire\Admin\Settings\Staffsettings\Designation;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Designationliverwire extends Component
{
    use WithPagination;

    public $staffdesignationid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $designationsubmitbtn = true;

    public $designationshowdata;

    public $isshowmodalopen = false;

    public function designationshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function designationclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->designationshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:staffdesignations,name,' . $this->staffdesignationid,
        ];
    }

    public function updated($propertyName)
    {
        $this->designationsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->designationsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->staffdesignationid) {
                $staffdesignationmodel = Staffdesignation::find($this->staffdesignationid);

                $staffdesignationmodel->name = $this->name;

                if ($staffdesignationmodel->isDirty()) {
                    $staffdesignationmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Staffdesignation Update', 'admin_web_staffdesignation_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Staff Designation Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('staffdesignation_field_focus_trigger');
                }
            } else {
                Staffdesignation::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Staffdesignation Create', 'admin_web_staffdesignation_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Designation Added Successfully!']);
            }
            $this->designationsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Staffdesignation $staffdesignation)
    {
        $this->designationshowdata = $staffdesignation;
        $this->designationshowmodal();
    }

    public function edit(Staffdesignation $staffdesignation)
    {
        $this->name = $staffdesignation->name;
        $this->staffdesignationid = $staffdesignation->id;
        $this->emit('staffdesignation_field_focus_trigger');
    }

    public function deleteconfirm($staffdesignationid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['staffdesignationid' => $staffdesignationid]);
    }

    public function delete(Staffdesignation $staffdesignation)
    {
        try {
            DB::beginTransaction();

            $staffdesignation->delete();
            Helper::trackmessage(auth()->user(), 'Admin Staffdesignation Delete', 'admin_web_staffdesignation_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Staff Designation Deleted!']);

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
        $this->staffdesignationid = null;
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
        $staffdesignation = Staffdesignation::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.staffsettings.designation.designationliverwire', compact('staffdesignation'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_staffdesignation_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
