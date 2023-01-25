<?php

namespace App\Http\Livewire\Admin\Settings\Feesettings\Feeparticular;

use App\Models\Admin\Settings\Feesetting\Feeparticular;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Feeparticularliverwire extends Component
{
    use WithPagination;

    public $feeparticularid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $feeparticularsubmitbtn = true;

    public $feeparticularshowdata;

    public $isshowmodalopen = false;

    public function feeparticularshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function feeparticularclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->feeparticularshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:feeparticulars,name,' . $this->feeparticularid,
        ];
    }

    public function updated($propertyName)
    {
        $this->feeparticularsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->feeparticularsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->feeparticularid) {
                $feeparticularmodel = Feeparticular::find($this->feeparticularid);

                $feeparticularmodel->name = $this->name;

                if ($feeparticularmodel->isDirty()) {
                    $feeparticularmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Feeparticular Update', 'admin_web_feeparticular_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Feeparticular Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('feeparticular_field_focus_trigger');
                }

            } else {
                Feeparticular::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Feeparticular Create', 'admin_web_feeparticular_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Feeparticular Added Successfully!']);
            }
            $this->feeparticularsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Feeparticular $feeparticular)
    {
        $this->feeparticularshowdata = $feeparticular;
        $this->feeparticularshowmodal();
    }

    public function edit(Feeparticular $feeparticular)
    {
        $this->name = $feeparticular->name;
        $this->feeparticularid = $feeparticular->id;
        $this->emit('feeparticular_field_focus_trigger');
    }

    public function deleteconfirm($feeparticularid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['feeparticularid' => $feeparticularid]);
    }

    public function delete(Feeparticular $feeparticular)
    {
        try {
            DB::beginTransaction();

            $feeparticular->delete();
            Helper::trackmessage(auth()->user(), 'Admin Feeparticular Delete', 'admin_web_feeparticular_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Feeparticular Deleted!']);

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
        $this->feeparticularid = null;
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
        $feeparticular = Feeparticular::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.feesettings.feeparticular.feeparticularliverwire', compact('feeparticular'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_feeparticular_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
