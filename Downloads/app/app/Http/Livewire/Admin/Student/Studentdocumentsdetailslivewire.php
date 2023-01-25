<?php

namespace App\Http\Livewire\Admin\Student;

use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentdocumentsdetailslivewire extends Component
{
    public $student;

    public function mount($student)
    {
        $this->student = $student;
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }
    public function render()
    {
        return view('livewire.admin.student.studentdocumentsdetailslivewire');
    }
}
