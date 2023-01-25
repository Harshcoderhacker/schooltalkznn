<?php

namespace App\Http\Livewire\Admin\Settings\Feesettings\Coa;

use App\Models\Admin\Settings\Feesetting\Coa;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Coaliverwire extends Component
{
    use WithPagination;

    public $coaid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $coasubmitbtn = true;

    public $coashowdata;

    public $isshowmodalopen = false;

    public function coashowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function coaclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->coashowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:coas,name,' . $this->coaid,
        ];
    }

    public function updated($propertyName)
    {
        $this->coasubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->coasubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->coaid) {
                $coamodel = Coa::find($this->coaid);

                $coamodel->name = $this->name;

                if ($coamodel->isDirty()) {
                    $coamodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin COA Update', 'admin_web_coa_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'COA Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('coa_field_focus_trigger');
                }
            } else {
                Coa::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin COA Create', 'admin_web_coa_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'COA Added Successfully!']);
            }
            $this->coasubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Coa $coa)
    {
        $this->coashowdata = $coa;
        $this->coashowmodal();
    }

    public function edit(Coa $coa)
    {
        $this->name = $coa->name;
        $this->coaid = $coa->id;
        $this->emit('coa_field_focus_trigger');
    }

    public function deleteconfirm($coaid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['coaid' => $coaid]);
    }

    public function delete(Coa $coa)
    {
        try {
            DB::beginTransaction();

            $coa->delete();
            Helper::trackmessage(auth()->user(), 'Admin COA Delete', 'admin_web_coa_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'COA Deleted!']);

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
        $this->coaid = null;
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
        $coa = Coa::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.feesettings.coa.coaliverwire', compact('coa'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_coa_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
