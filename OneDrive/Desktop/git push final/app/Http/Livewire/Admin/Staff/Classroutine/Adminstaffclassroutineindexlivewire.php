<?php

namespace App\Http\Livewire\Admin\Staff\Classroutine;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Staff\Auth\Staff;
use Livewire\Component;

class Adminstaffclassroutineindexlivewire extends Component
{
    public $designationid;
    public $stafflist = [], $staff_id;
    public $selectedstaff;

    public function updatedDesignationid()
    {
        if ($this->designationid != 0) {
            $this->stafflist = Staff::where('staffdesignation_id', $this->designationid)
                ->get();
        }
    }

    public function updatedStaffid()
    {
        if ($this->staff_id != 0) {
            $this->selectedstaff = $this->staff_id;
        }
    }

    public function render()
    {
        $designation = Staffdesignation::where('active', true)->get();
        return view('livewire.admin.staff.classroutine.adminstaffclassroutineindexlivewire', compact('designation'));
    }
}
