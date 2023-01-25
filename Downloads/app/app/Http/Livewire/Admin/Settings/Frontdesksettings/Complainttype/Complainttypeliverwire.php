<?php

namespace App\Http\Livewire\Admin\Settings\Frontdesksettings\Complainttype;

use App\Models\Admin\Settings\Frontdesksetting\Complainttype;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Complainttypeliverwire extends Component
{
    use WithPagination;

    public $complainttypeid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $complainttypesubmitbtn = true;

    public $complainttypeshowdata;

    public $isshowmodalopen = false;

    public function complainttypeshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function complainttypeclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->complainttypeshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:complainttypes,name,' . $this->complainttypeid,
        ];
    }

    public function updated($propertyName)
    {
        $this->complainttypesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->complainttypesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->complainttypeid) {
                $complainttypemodel = Complainttype::find($this->complainttypeid);

                $complainttypemodel->name = $this->name;

                if ($complainttypemodel->isDirty()) {
                    $complainttypemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Complainttype Update', 'admin_web_complainttype_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Complainttype Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('complainttype_field_focus_trigger');
                }
            } else {
                Complainttype::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Complainttype Create', 'admin_web_complainttype_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Complainttype Added Successfully!']);
            }
            $this->complainttypesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Complainttype $complainttype)
    {
        $this->complainttypeshowdata = $complainttype;
        $this->complainttypeshowmodal();
    }

    public function edit(Complainttype $complainttype)
    {
        $this->name = $complainttype->name;
        $this->complainttypeid = $complainttype->id;
        $this->emit('complainttype_field_focus_trigger');
    }

    public function deleteconfirm($complainttypeid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['complainttypeid' => $complainttypeid]);
    }

    public function delete(Complainttype $complainttype)
    {
        try {
            DB::beginTransaction();

            $complainttype->delete();
            Helper::trackmessage(auth()->user(), 'Admin Complainttype Delete', 'admin_web_complainttype_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Complainttype Deleted!']);

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
        $this->complainttypeid = null;
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
        $complainttype = Complainttype::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.frontdesksettings.complainttype.complainttypeliverwire', compact('complainttype'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_complainttype_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
