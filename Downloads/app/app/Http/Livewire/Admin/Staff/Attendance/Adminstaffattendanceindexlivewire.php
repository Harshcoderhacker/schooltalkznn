<?php

namespace App\Http\Livewire\Admin\Staff\Attendance;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Adminstaffattendanceindexlivewire extends Component
{
    use WithPagination;

    public $paginationlength = 10;
    public $openattendance = false;
    public $showstaffattendance;
    public $designationid, $designation, $attendance_date;
    public $todayattendancepercentage;
    public $staffcount;

    public function mount()
    {
        $count = 0;

        $this->attendance_date = Carbon::today()->format('Y-m-d');
        $this->designation = Staffdesignation::where('active', true)->get();
        $this->staffcount = Staff::where('active', true)->count();

        $staffattendance = Staffattendance::where('attendance_date', $this->attendance_date)
            ->where('attendance_status', true)
            ->where('is_holiday', false)
            ->get();

        foreach ($staffattendance as $value) {
            $count += count($value->presentstaff);
        }

        if ($count == 0) {
            $this->todayattendancepercentage = 0;
        } else {
            $this->todayattendancepercentage = round(($count / $this->staffcount) * 100);
        }

    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function closeattendancemodal()
    {
        $this->showstaffattendance = null;
        $this->openattendance = false;
    }

    public function showattendancemodel(Staffattendance $staffattendanceid)
    {
        $this->showstaffattendance = $staffattendanceid;
        $this->openattendance = true;
    }

    public function sendnotification()
    {
        $this->dispatchBrowserEvent('warningtoast', ['message' => 'Coming Soon']);
    }

    public function render()
    {
        $staffattendance = Staffattendance::where('active', true)
            ->where(fn($query) => ($this->designationid) ? $query->where('staffdesignation_id', $this->designationid) : '')
            ->where(fn($query) => ($this->attendance_date) ? $query->where('attendance_date', $this->attendance_date) : '')
            ->latest()
            ->paginate($this->paginationlength);

        return view('livewire.admin.staff.attendance.adminstaffattendanceindexlivewire', compact('staffattendance'));
    }
}
