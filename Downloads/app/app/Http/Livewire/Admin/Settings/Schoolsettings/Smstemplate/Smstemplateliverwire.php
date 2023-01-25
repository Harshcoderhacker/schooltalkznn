<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Smstemplate;

use App\Models\Admin\Settings\Schoolsetting\Smstemplate;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Smstemplateliverwire extends Component
{
    use WithPagination;

    public $smstemplateid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $smstemplatesubmitbtn = true;

    public $smstemplateshowdata;

    public $isshowmodalopen = false;

    public function smstemplateshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function smstemplateclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->smstemplateshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:smstemplates,name,' . $this->smstemplateid,
        ];
    }

    public function updated($propertyName)
    {
        $this->smstemplatesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->smstemplatesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->smstemplateid) {
                $smstemplatemodel = Smstemplate::find($this->smstemplateid);

                $smstemplatemodel->name = $this->name;

                if ($smstemplatemodel->isDirty()) {
                    $smstemplatemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Smstemplate Update', 'admin_web_smstemplate_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Smstemplate Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('smstemplate_field_focus_trigger');
                }
            } else {
                Smstemplate::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Smstemplate Create', 'admin_web_smstemplate_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Smstemplate Added Successfully!']);
            }
            $this->smstemplatesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Smstemplate $smstemplate)
    {
        $this->smstemplateshowdata = $smstemplate;
        $this->smstemplateshowmodal();
    }

    public function edit(Smstemplate $smstemplate)
    {
        $this->name = $smstemplate->name;
        $this->smstemplateid = $smstemplate->id;
        $this->emit('smstemplate_field_focus_trigger');
    }

    public function deleteconfirm($smstemplateid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['smstemplateid' => $smstemplateid]);
    }

    public function delete(Smstemplate $smstemplate)
    {

        try {
            DB::beginTransaction();

            $smstemplate->delete();
            Helper::trackmessage(auth()->user(), 'Admin Smstemplate Delete', 'admin_web_smstemplate_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Smstemplate Deleted!']);

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
        $this->smstemplateid = null;
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
        $smstemplate = Smstemplate::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.smstemplate.smstemplateliverwire', compact('smstemplate'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_smstemplate_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
