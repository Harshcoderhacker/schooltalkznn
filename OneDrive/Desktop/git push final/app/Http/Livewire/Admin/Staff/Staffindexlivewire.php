<?php

namespace App\Http\Livewire\Admin\Staff;

use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Staffindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'name';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $staffshowdata;

    public $isshowmodalopen = false;

    public $department, $designation;

    public $departmentid, $designationid, $staffid;

    public $staffcount;

    public $todayattendancepercentage;

    public function staffshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function staffclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->staffshowdata = [];
    }

    public function mount()
    {
        $this->department = Staffdepartment::where('active', true)->get();
        $this->staffcount = Staff::where('active', true)->count();
        $this->designation = [];

        $today = Carbon::today();
        $count = 0;

        $staffattendance = Staffattendance::where('attendance_date', $today)
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

    public function updateddepartmentid()
    {
        $this->designationid = '';
        if ($this->departmentid) {
            $this->designation = Staffdesignation::where('active', true)->get();
        } else {
            $this->designation = [];
        }
    }
    public function show(Staff $staff)
    {
        $this->staffshowdata = $staff;
        $this->staffshowmodal();
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
        $staff = Staff::with('staffdepartment', 'staffdesignation')
            ->where(fn($query) => ($this->departmentid) ? $query->where('staffdepartment_id', $this->departmentid) : '')
            ->where(fn($query) => ($this->designationid) ? $query->where('staffdesignation_id', $this->designationid) : '')
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.staff.staffindexlivewire', compact('staff'));
    }
}
