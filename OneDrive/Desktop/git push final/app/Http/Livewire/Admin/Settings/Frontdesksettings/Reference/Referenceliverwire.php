<?php

namespace App\Http\Livewire\Admin\Settings\Frontdesksettings\Reference;

use App\Models\Admin\Settings\Frontdesksetting\Reference;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Referenceliverwire extends Component
{
    use WithPagination;

    public $referenceid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $referencesubmitbtn = true;

    public $referenceshowdata;

    public $isshowmodalopen = false;

    public function referenceshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function referenceclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->referenceshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:references,name,' . $this->referenceid,
        ];
    }

    public function updated($propertyName)
    {
        $this->referencesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->referencesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->referenceid) {
                $referencemodel = Reference::find($this->referenceid);

                $referencemodel->name = $this->name;

                if ($referencemodel->isDirty()) {

                    $referencemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Reference Update', 'admin_web_reference_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Reference Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('reference_field_focus_trigger');
                }
            } else {
                Reference::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Reference Create', 'admin_web_reference_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Reference Added Successfully!']);
            }
            $this->referencesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Reference $reference)
    {
        $this->referenceshowdata = $reference;
        $this->referenceshowmodal();
    }

    public function edit(Reference $reference)
    {
        $this->name = $reference->name;
        $this->referenceid = $reference->id;
        $this->emit('reference_field_focus_trigger');
    }

    public function deleteconfirm($referenceid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['referenceid' => $referenceid]);
    }

    public function delete(Reference $reference)
    {
        try {
            DB::beginTransaction();

            $reference->delete();
            Helper::trackmessage(auth()->user(), 'Admin Reference Delete', 'admin_web_reference_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Reference Deleted!']);

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
        $this->referenceid = null;
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
        $reference = Reference::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.frontdesksettings.reference.referenceliverwire', compact('reference'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_reference_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
