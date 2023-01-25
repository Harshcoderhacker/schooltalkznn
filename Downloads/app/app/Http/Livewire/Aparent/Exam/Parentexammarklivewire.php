<?php

namespace App\Http\Livewire\Aparent\Exam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Parentexammarklivewire extends Component
{
    public $user, $examlist = [];
    public $exam_id;
    public $average;

    public function mount()
    {
        $this->user = Parenthelper::getstudentweb();
        $this->examlist = Exam::where('academicyear_id', $this->user->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->whereJsonContains('section', (string) $this->user->section_id)->get();
    }

    public function render()
    {
        $exam = Exam::with('examsubject')->where('academicyear_id', $this->user->academicyear_id)->where('id', $this->exam_id)
            ->get();
        $totalavg = Examstudentsubjectlist::where('exam_id', $this->exam_id)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->user->id)->where('classmaster_id', $this->user->classmaster_id)
                    ->where('section_id', $this->user->section_id))->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();
        return view('livewire.aparent.exam.parentexammarklivewire', compact('exam', 'totalavg', 'grade', 'passpercentage'));
    }
}
