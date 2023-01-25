<?php

namespace App\Http\Livewire\Aparent\Exam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Parenthelper\Parenthelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Parentexamprogresscardlivewire extends Component
{
    public $user, $examid;

    public $examlist = [];

    public $academicyear_id;

    public function mount()
    {
        $this->user = Parenthelper::getstudentweb();
        $this->examlist = Exam::where('academicyear_id', $this->user->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->whereJsonContains('section', (string) $this->user->section_id)->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function downloadmarksheetreport()
    {
        $total_mark = [];
        $section_name = $this->user->section->name;
        $studentlist = Student::where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->where('section_id', $this->user->classmaster_id)
            ->get();
        $student = $this->user;
        foreach ($studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('student_id', $eachstudent->id)->where('classmaster_id', $this->user->classmaster_id)
                ->where('section_id', $this->user->section_id)->get();
            if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->id] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($total_mark);

        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->examid)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->user->id)->where('classmaster_id', $this->user->classmaster_id)
                    ->where('section_id', $this->user->section_id))->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();

        $pdf = Pdf::loadView('admin.report.examreport.pdf.marksheetreport',
            compact('exam', 'examsubjectmark', 'grade', 'passpercentage', 'student', 'total_mark', 'section_name'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Evaluation Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Marksheetreport.pdf');
    }

    public function render()
    {
        $total_mark = [];
        $studentlist = Student::where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->where('section_id', $this->user->section_id)
            ->get();
        foreach ($studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('student_id', $eachstudent->id)->where('classmaster_id', $this->user->classmaster_id)
                ->where('section_id', $this->user->section_id)->get();
            if ($examstudentlist->isNotEmpty()) {
                if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                    $total_mark[$eachstudent->id] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
                }
            }
        }
        arsort($total_mark);

        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->examid)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->user->id)->where('classmaster_id', $this->user->classmaster_id)
                    ->where('section_id', $this->user->section_id))->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();
        return view('livewire.aparent.exam.parentexamprogresscardlivewire', compact('exam', 'examsubjectmark', 'grade', 'passpercentage', 'total_mark'));
    }
}
