<?php

namespace App\Http\Livewire\Staff\Classroutine;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Staff\Auth\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Classroutinestafflivewire extends Component
{
    public $user_id;

    public function mount($staff_id)
    {
        if ($staff_id) {
            $this->user_id = $staff_id;
        } else {
            $this->user_id = auth()->guard('staff')->user()->id;
        }
        $this->weekend = Weekend::where('active', true)->get();
        $this->classroutine = Classroutine::where('active', true)->get();
    }

    public function printtimetable()
    {
        $weekend = $this->weekend;
        $classroutine = $this->classroutine;
        $staff = Staff::find($this->user_id);

        $pdf = Pdf::loadView('common.adminstaffclassroutineindexpdf',
            compact('weekend', 'classroutine', 'staff'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Attendance Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'StaffTimetable.pdf');
    }

    public function render()
    {
        return view('livewire.staff.classroutine.classroutinestafflivewire');
    }
}
