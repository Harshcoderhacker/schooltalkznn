<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Emailtemplate;

use App\Models\Admin\Settings\Schoolsetting\Emailtemplate;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Emailtemplateliverwire extends Component
{
    use WithPagination;

    public $emailtemplateid, $name;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $emailtemplatesubmitbtn = true;

    public $emailtemplateshowdata;

    public $isshowmodalopen = false;

    public function emailtemplateshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function emailtemplateclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->emailtemplateshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35|unique:emailtemplates,name,' . $this->emailtemplateid,
        ];
    }

    public function updated($propertyName)
    {
        $this->emailtemplatesubmitbtn = true;
        $this->validateOnly($propertyName);
        $this->emailtemplatesubmitbtn = false;
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->emailtemplateid) {
                $emailtemplatemodel = Emailtemplate::find($this->emailtemplateid);

                $emailtemplatemodel->name = $this->name;

                if ($emailtemplatemodel->isDirty()) {
                    $emailtemplatemodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Emailtemplate Update', 'admin_web_emailtemplate_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Emailtemplate Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('emailtemplate_field_focus_trigger');
                }
            } else {
                Emailtemplate::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Emailtemplate Create', 'admin_web_emailtemplate_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Emailtemplate Added Successfully!']);
            }
            $this->emailtemplatesubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Emailtemplate $emailtemplate)
    {
        $this->emailtemplateshowdata = $emailtemplate;
        $this->emailtemplateshowmodal();
    }

    public function edit(Emailtemplate $emailtemplate)
    {
        $this->name = $emailtemplate->name;
        $this->emailtemplateid = $emailtemplate->id;
        $this->emit('emailtemplate_field_focus_trigger');
    }

    public function deleteconfirm($emailtemplateid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['emailtemplateid' => $emailtemplateid]);
    }

    public function delete(Emailtemplate $emailtemplate)
    {

        try {
            DB::beginTransaction();

            $emailtemplate->delete();
            Helper::trackmessage(auth()->user(), 'Admin Emailtemplate Delete', 'admin_web_emailtemplate_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Emailtemplate Deleted!']);

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
        $this->emailtemplateid = null;
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
        $emailtemplate = Emailtemplate::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.emailtemplate.emailtemplateliverwire', compact('emailtemplate'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_emailtemplate_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
