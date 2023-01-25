<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentmarksdetailslivewire extends Component
{
    public $student, $studentlist = [], $examid, $examsubjectmark, $selectedexam, $examlist = [], $grade = [], $passpercentage, $academicyear_id, $total_mark = [];

    public function mount($student)
    {
        $this->student = $student;
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->examlist = Exam::where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->student->classmaster_id)
            ->whereJsonContains('section', (string) $this->student->section_id)
            ->get();
        $this->grade = Examgrade::where('active', true)->get();
        $this->passpercentage = Exampasspercentage::where('active', true)->get();
    }

    public function updatedExamid()
    {
        if ($this->examid) {
            $this->studentlist = Student::where('academicyear_id', $this->academicyear_id)
                ->where('classmaster_id', $this->student->classmaster_id)
                ->where('section_id', $this->student->section_id)
                ->get();
            $this->marks();
        } else {
            $this->studentlist = [];
        }
    }

    public function marks()
    {
        foreach ($this->studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('student_id', $eachstudent->id)->where('classmaster_id', $this->student->classmaster_id)
                ->where('section_id', $this->student->section_id)->get();
            if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                $this->total_mark[$eachstudent->id] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($this->total_mark);

        $this->selectedexam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $this->examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->examid)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->student->id)->where('classmaster_id', $this->student->classmaster_id)
                    ->where('section_id', $this->student->section_id))->get();
    }

    public function render()
    {
        return view('livewire.admin.student.studentmarksdetailslivewire');
    }
}
