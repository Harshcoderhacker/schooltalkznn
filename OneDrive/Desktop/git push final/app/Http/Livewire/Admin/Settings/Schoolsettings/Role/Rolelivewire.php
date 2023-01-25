<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Role;

use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Rolelivewire extends Component
{
    use WithPagination;

    public $roleid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $rolesubmitbtn = true;

    public $roleshowdata;

    public $isshowmodalopen = false;

    public function roleshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function roleclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->roleshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:10|unique:roles,name,' . $this->roleid,
        ];
    }

    public function updated($propertyName)
    {
        $this->rolesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->rolesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->roleid) {
                $rolemodel = Role::find($this->roleid);

                $rolemodel->name = $this->name;

                if ($rolemodel->isDirty()) {
                    $rolemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Role Update', 'admin_web_role_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Role Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('role_field_focus_trigger');
                }
            } else {
                Role::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Role Create', 'admin_web_role_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Role Added Successfully!']);
            }
            $this->rolesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Role $role)
    {
        $this->roleshowdata = $role;
        $this->roleshowmodal();
    }

    public function edit(Role $role)
    {
        $this->name = $role->name;
        $this->roleid = $role->id;
        $this->emit('role_field_focus_trigger');
    }

    public function deleteconfirm($roleid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['roleid' => $roleid]);
    }

    public function delete(Role $role)
    {

        try {
            DB::beginTransaction();

            $role->delete();
            Helper::trackmessage(auth()->user(), 'Admin Role Delete', 'admin_web_role_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Role Deleted!']);

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
        $this->roleid = null;
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
        $role = Role::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.role.rolelivewire', compact('role'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_role_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
