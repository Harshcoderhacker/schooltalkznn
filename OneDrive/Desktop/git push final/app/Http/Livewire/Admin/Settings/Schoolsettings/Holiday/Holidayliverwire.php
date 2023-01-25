<?php

namespace App\Http\Livewire\Admin\Settings\Schoolsettings\Holiday;

use App\Models\Admin\Settings\Schoolsetting\Holiday;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Holidayliverwire extends Component
{
    use WithPagination;

    public $holidayid, $name, $start_date, $end_date;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $holidayshowdata;

    public $isshowmodalopen = false;

    public function holidayshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function holidayclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->holidayshowdata = [];
    }

    protected function rules()
    {
        return [
            'name' => 'required|min:1|max:35',
            'start_date' => 'required',
            'end_date' => 'required|after_or_equal:start_date',
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

            if ($this->holidayid) {
                $holidaymodel = Holiday::find($this->holidayid);

                $holidaymodel->name = $this->name;
                $holidaymodel->start_date = $this->start_date;
                $holidaymodel->end_date = $this->end_date;

                if ($holidaymodel->isDirty()) {

                    $holidaymodel->save();

                    Helper::trackmessage(auth()->user(), 'Admin Holiday Update', 'admin_web_holiday_create', session()->getId(), 'WEB');
                    DB::commit();
                    $this->formreset();
                    $this->resetPage();
                    $this->dispatchBrowserEvent('updatetoast', ['message' => 'Holiday Updated Successfully!']);

                } else {
                    DB::rollback();
                    $this->dispatchBrowserEvent('warningtoast', ['message' => 'No Changes has been made!']);
                    $this->emit('holiday_field_focus_trigger');
                }
            } else {
                Holiday::create($validated);
                Helper::trackmessage(auth()->user(), 'Admin Holiday Create', 'admin_web_holiday_create', session()->getId(), 'WEB');

                DB::commit();
                $this->formreset();
                $this->resetPage();
                $this->dispatchBrowserEvent('successtoast', ['message' => 'Holiday Added Successfully!']);
            }
            $this->holidaysubmitbtn = true;

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }

    }

    public function show(Holiday $holiday)
    {
        $this->holidayshowdata = $holiday;
        $this->holidayshowmodal();
    }

    public function edit(Holiday $holiday)
    {
        $this->name = $holiday->name;
        $this->start_date = Carbon::parse($holiday->start_date)->format('Y-m-d');
        $this->end_date = Carbon::parse($holiday->end_date)->format('Y-m-d');
        $this->holidayid = $holiday->id;
        $this->emit('holiday_field_focus_trigger');
    }

    public function deleteconfirm($holidayid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['holidayid' => $holidayid]);
    }

    public function delete(Holiday $holiday)
    {

        try {
            DB::beginTransaction();

            $holiday->delete();
            Helper::trackmessage(auth()->user(), 'Admin Holiday Delete', 'admin_web_holiday_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->resetPage();

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
        $this->start_date = null;
        $this->end_date = null;
        $this->holidayid = null;
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
        $holiday = Holiday::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.schoolsettings.holiday.holidayliverwire', compact('holiday'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_holiday_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
