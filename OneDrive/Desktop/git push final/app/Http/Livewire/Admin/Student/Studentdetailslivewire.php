<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentdetailslivewire extends Component
{
    public $student, $studentlist = [], $feeassignstudent, $exam, $examid, $examsubjectmark, $selectedexam, $examlist = [], $grade = [], $passpercentage, $academicyear_id, $total_mark = [];

    public function mount($student)
    {
        $this->student = $student;
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }
    public function fees()
    {
        $this->feeassignstudent = Feeassignstudent::where('student_id', $this->student->id)
            ->where('is_selected', true)->get();
    }

    public function activetab($status)
    {
        $this->activestatus = $status;
    }

    public function progress()
    {
        $this->exam = Exam::with('examsubject')->where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->student->classmaster_id)
            ->whereJsonContains('section', (string) $this->student->section_id)
            ->get();

        $this->grade = Examgrade::where('active', true)->get();
        $this->passpercentage = Exampasspercentage::where('active', true)->get();
    }

    public function render()
    {
        $this->fees();
        $this->progress();
        return view('livewire.admin.student.studentdetailslivewire');
    }
}
