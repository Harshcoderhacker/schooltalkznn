<?php

namespace App\Http\Livewire\Admin\Settings\Feesettings\Feediscount;

use App\Models\Admin\Settings\Feesetting\Feediscount;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Feediscountliverwire extends Component
{
    use WithPagination;

    public $feediscountid, $name, $amount;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $feediscountsubmitbtn = true;

    public $feediscountshowdata;

    public $isshowmodalopen = false;

    public function feediscountshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function feediscountclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->feediscountshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:feediscounts,name,' . $this->feediscountid,
            'amount' => 'required|numeric',
        ];
    }

    public function updated($propertyName)
    {
        $this->feediscountsubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->feediscountsubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->feediscountid) {
                $feediscountmodel = Feediscount::find($this->feediscountid);

                $feediscountmodel->name = $this->name;
                $feediscountmodel->amount = $this->amount;

                if ($feediscountmodel->isDirty()) {
                    $feediscountmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Feediscount Update', 'admin_web_feediscount_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Feediscount Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('feediscount_field_focus_trigger');
                }

            } else {
                Feediscount::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Feediscount Create', 'admin_web_feediscount_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Feediscount Added Successfully!']);
            }
            $this->feediscountsubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Feediscount $feediscount)
    {
        $this->feediscountshowdata = $feediscount;
        $this->feediscountshowmodal();
    }

    public function edit(Feediscount $feediscount)
    {
        $this->name = $feediscount->name;
        $this->amount = $feediscount->amount;
        $this->feediscountid = $feediscount->id;
        $this->emit('feediscount_field_focus_trigger');
    }

    public function deleteconfirm($feediscountid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['feediscountid' => $feediscountid]);
    }

    public function delete(Feediscount $feediscount)
    {
        try {
            DB::beginTransaction();

            $feediscount->delete();
            Helper::trackmessage(auth()->user(), 'Admin Feediscount Delete', 'admin_web_feediscount_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Feediscount Deleted!']);

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
        $this->amount = null;
        $this->feediscountid = null;
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
        $feediscount = Feediscount::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.feesettings.feediscount.feediscountliverwire', compact('feediscount'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_feediscount_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
