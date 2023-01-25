<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentprogressdetailslivewire extends Component
{
    public $student, $exam, $grade = [], $passpercentage, $academicyear_id;

    public function mount($student)
    {
        $this->student = $student;
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->grade = Examgrade::where('active', true)->get();
        $this->passpercentage = Exampasspercentage::where('active', true)->get();
    }

    public function progress()
    {
        $this->exam = Exam::with('examsubject')->where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->student->classmaster_id)
            ->whereJsonContains('section', (string) $this->student->section_id)
            ->get();
    }

    public function render()
    {
        $this->progress();
        return view('livewire.admin.student.studentprogressdetailslivewire');
    }
}
