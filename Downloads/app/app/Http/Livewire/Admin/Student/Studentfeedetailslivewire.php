<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use Livewire\Component;

class Studentfeedetailslivewire extends Component
{
    public $feeassignstudent, $student;

    public function mount($student)
    {
        $this->student = $student;
    }

    public function render()
    {
        $this->feeassignstudent = Feeassignstudent::where('student_id', $this->student->id)
            ->where('is_selected', true)->get();
        return view('livewire.admin.student.studentfeedetailslivewire');
    }
}
