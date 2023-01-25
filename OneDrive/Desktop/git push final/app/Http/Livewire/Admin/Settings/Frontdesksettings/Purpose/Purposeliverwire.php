<?php

namespace App\Http\Livewire\Admin\Settings\Frontdesksettings\Purpose;

use App\Models\Admin\Settings\Frontdesksetting\Purpose;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Purposeliverwire extends Component
{
    use WithPagination;

    public $purposeid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $purposesubmitbtn = true;

    public $purposeshowdata;

    public $isshowmodalopen = false;

    public function purposeshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function purposeclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->purposeshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:purposes,name,' . $this->purposeid,
        ];
    }

    public function updated($propertyName)
    {
        $this->purposesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->purposesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->purposeid) {
                $purposemodel = Purpose::find($this->purposeid);

                $purposemodel->name = $this->name;

                if ($purposemodel->isDirty()) {
                    $purposemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Purpose Update', 'admin_web_purpose_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Purpose Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('purpose_field_focus_trigger');
                }
            } else {
                Purpose::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Purpose Create', 'admin_web_purpose_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Purpose Added Successfully!']);
            }
            $this->purposesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Purpose $purpose)
    {
        $this->purposeshowdata = $purpose;
        $this->purposeshowmodal();
    }

    public function edit(Purpose $purpose)
    {
        $this->name = $purpose->name;
        $this->purposeid = $purpose->id;
        $this->emit('purpose_field_focus_trigger');
    }

    public function deleteconfirm($purposeid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['purposeid' => $purposeid]);
    }

    public function delete(Purpose $purpose)
    {
        try {
            DB::beginTransaction();

            $purpose->delete();
            Helper::trackmessage(auth()->user(), 'Admin Purpose Delete', 'admin_web_purpose_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Purpose Deleted!']);

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
        $this->purposeid = null;
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
        $purpose = Purpose::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.frontdesksettings.purpose.purposeliverwire', compact('purpose'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_purpose_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
