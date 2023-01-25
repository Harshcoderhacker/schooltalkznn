<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Academicyear;

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Academicyearliverwire extends Component
{
    use WithPagination;

    public $academicyearid, $year, $title, $start_date, $end_date;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'asc';

    public $paginationlength = 10;

    public $academicyearshowdata;

    public $isshowmodalopen = false;

    public function academicyearshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function academicyearclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->academicyearshowdata = [];
    }

    protected function rules()
    {
        return [
            'year' => 'required|numeric|min:2022|unique:academicyears,year,' . $this->academicyearid,
            'title' => 'required|min:1|max:35',
            'start_date' => 'required',
            'end_date' => 'required|after:start_date',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createorupdate()
    {
        try {
            DB::beginTransaction();

            $validated = $this->validate();
            $user = auth()->user();

            if ($this->academicyearid) {
                $academicyearmodel = Academicyear::find($this->academicyearid);

                $academicyearmodel->year = $this->year;
                $academicyearmodel->title = $this->title;
                $academicyearmodel->start_date = $this->start_date;
                $academicyearmodel->end_date = $this->end_date;

                if ($academicyearmodel->isDirty()) {
                    $academicyearmodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Academicyear Update', 'admin_web_academicyear_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Academicyear Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('academicyear_field_focus_trigger');
                }

            } else {
                Academicyear::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Academicyear Create', 'admin_web_academicyear_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Academicyear Added Successfully!']);
            }

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Academicyear $academicyear)
    {
        $this->academicyearshowdata = $academicyear;
        $this->academicyearshowmodal();
    }

    public function edit(Academicyear $academicyear)
    {
        $this->year = $academicyear->year;
        $this->title = $academicyear->title;
        $this->start_date = Carbon::parse($academicyear->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($academicyear->end_date)->format('Y-m-d');
        $this->academicyearid = $academicyear->id;
        $this->emit('academicyear_field_focus_trigger');
    }

    public function deleteconfirm($academicyearid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['academicyearid' => $academicyearid]);
    }

    public function delete(Academicyear $academicyear)
    {

        try {
            DB::beginTransaction();

            $academicyear->delete();
            Helper::trackmessage(auth()->user(), 'Admin Academicyear Delete', 'admin_web_academicyear_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Academicyear Deleted!']);

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
        $this->year = null;
        $this->title = null;
        $this->start_date = null;
        $this->end_date = null;
        $this->academicyearid = null;
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
        $academicyear = Academicyear::query()
            ->where('year', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.academicyear.academicyearliverwire', compact('academicyear'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_academicyear_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
