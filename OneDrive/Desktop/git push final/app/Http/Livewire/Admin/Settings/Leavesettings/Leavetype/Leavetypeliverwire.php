<?php

namespace App\Http\Livewire\Admin\Settings\Leavesettings\Leavetype;

use App\Models\Admin\Settings\Leavesetting\Leavetype;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Leavetypeliverwire extends Component
{
    use WithPagination;

    public $leavetypeid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $leavetypesubmitbtn = true;

    public $leavetypeshowdata;

    public $isshowmodalopen = false;

    public function leavetypeshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function leavetypeclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->leavetypeshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:leavetypes,name,' . $this->leavetypeid,
        ];
    }

    public function updated($propertyName)
    {
        $this->leavetypesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->leavetypesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->leavetypeid) {
                $leavetypemodel = Leavetype::find($this->leavetypeid);

                $leavetypemodel->name = $this->name;

                if ($leavetypemodel->isDirty()) {
                    $leavetypemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Leavetype Update', 'admin_web_leavetype_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Leavetype Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('leavetype_field_focus_trigger');
                }
            } else {
                Leavetype::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Leavetype Create', 'admin_web_leavetype_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Leavetype Added Successfully!']);
            }
            $this->leavetypesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Leavetype $leavetype)
    {
        $this->leavetypeshowdata = $leavetype;
        $this->leavetypeshowmodal();
    }

    public function edit(Leavetype $leavetype)
    {
        $this->name = $leavetype->name;
        $this->leavetypeid = $leavetype->id;
        $this->emit('leavetype_field_focus_trigger');
    }

    public function deleteconfirm($leavetypeid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['leavetypeid' => $leavetypeid]);
    }

    public function delete(Leavetype $leavetype)
    {
        try {
            DB::beginTransaction();

            $leavetype->delete();
            Helper::trackmessage(auth()->user(), 'Admin Leavetype Delete', 'admin_web_leavetype_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Leavetype Deleted!']);

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
        $this->leavetypeid = null;
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
        $leavetype = Leavetype::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.leavesettings.leavetype.leavetypeliverwire', compact('leavetype'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_leavetype_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
