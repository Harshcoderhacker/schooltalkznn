<?php

namespace App\Http\Livewire\Admin\Parent;

use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Parentindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 5;

    public $parentid;

    public $phone, $email, $name, $mother_name, $mother_occupation, $mother_phoneno;

    public $father_name, $father_occupation, $father_phoneno, $father_office_address;

    public $aparentshowdata;

    public $isModalFormOpen = false;

    public $isshowmodalopen = false;

    public function aparentshowmodal()
    {
        $this->isshowmodalopen = true;
    }

    public function aparentclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->aparentshowdata = [];
    }

    protected function rules()
    {
        return [
            'phone' => 'required|numeric|digits:10|unique:aparents,phone,' . $this->parentid,
            'email' => 'required|email',
            'name' => 'required|string',
            'mother_name' => 'required|string',
            'mother_occupation' => 'required|string',
            'mother_phoneno' => 'required|numeric|digits:10',
            'father_name' => 'required|string',
            'father_occupation' => 'required|string',
            'father_phoneno' => 'required|numeric|digits:10|different:mother_phoneno',
            'father_office_address' => 'required|string',
        ];
    }

    public function parentopenformModal()
    {
        $this->isModalFormOpen = true;
    }

    public function parentcloseFormModal()
    {
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
        $this->addparent();
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();

            $password = Str::random(8);
            $validated['password'] = $password;
            $validated['current_password'] = $password;

            Aparent::updateOrCreate(['id' => $this->parentid], $validated);

            Helper::trackmessage(auth()->user(),
                'Admin Aparent ' . ($this->parentid) ? 'Update' : 'Create',
                'admin_web_aprent_' . ($this->parentid) ? 'update' : 'create',
                session()->getId(),
                'WEB');

            DB::commit();
            $this->dispatchBrowserEvent('updatetoast', ['message' => ($this->parentid ? 'Parent Updated Successfully!' : 'Parent Created Successfully!')]);
            $this->parentid = null;
            $this->parentcloseformModal();

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Aparent $aparent)
    {
        $this->aparentshowdata = $aparent;
        $this->aparentshowmodal();
    }

    public function addparent()
    {
        $this->parentid = null;
        $this->phone = null;
        $this->email = null;
        $this->name = null;
        $this->mother_name = null;
        $this->mother_occupation = null;
        $this->mother_phoneno = null;
        $this->father_name = null;
        $this->father_occupation = null;
        $this->father_phoneno = null;
        $this->father_office_address = null;
    }

    public function edit(Aparent $aparent)
    {
        $this->parentid = $aparent->id;
        $this->phone = $aparent->phone;
        $this->email = $aparent->email;
        $this->name = $aparent->name;
        $this->mother_name = $aparent->mother_name;
        $this->mother_occupation = $aparent->mother_occupation;
        $this->mother_phoneno = $aparent->mother_phoneno;
        $this->father_name = $aparent->father_name;
        $this->father_occupation = $aparent->father_occupation;
        $this->father_phoneno = $aparent->father_phoneno;
        $this->father_office_address = $aparent->father_office_address;
        $this->parentopenformModal();
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
        $aparent = Aparent::query()
            ->where('phone', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.parent.parentindexlivewire', compact('aparent'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_parent_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
