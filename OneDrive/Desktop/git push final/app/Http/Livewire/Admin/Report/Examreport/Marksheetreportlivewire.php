<?php

namespace App\Http\Livewire\Admin\Report\Examreport;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Marksheetreportlivewire extends Component
{
    public $classmasterid, $sectionid, $studentid, $examid;

    public $classmaster, $section = [], $studentlist = [], $examlist = [];

    public $section_name;

    public $student;

    public $academicyear_id;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->examid = '';
            $this->section = [];
            $this->examlist = [];
            $this->studentlist = [];
        }
    }

    public function updatedSectionid()
    {
        $this->examid = '';
        if ($this->classmasterid && $this->sectionid) {
            $this->section_name = Section::find($this->sectionid)->name;
            $this->examlist = Exam::where('active', true)
                ->where('academicyear_id', $this->academicyear_id)
                ->where('classmaster_id', $this->classmasterid)
                ->whereJsonContains('section', (string) $this->sectionid)
                ->get();
        } else {
            $this->examlist = [];
            $this->studentlist = [];
        }
    }

    public function updatedExamid()
    {
        $this->studentid = '';
        if ($this->classmasterid && $this->sectionid && $this->examid) {
            $this->studentlist = Student::where('academicyear_id', $this->academicyear_id)
                ->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();
        } else {
            $this->studentlist = [];
        }
    }

    public function downloadmarksheetreport()
    {
        $total_mark = [];
        $section_name = $this->section_name;
        foreach ($this->studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('student_id', $eachstudent->id)->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)->get();
            if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->id] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($total_mark);
        $student = Student::where('id', $this->studentid)->where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->first();
        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->examid)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->studentid)->where('classmaster_id', $this->classmasterid)
                    ->where('section_id', $this->sectionid))->get();
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
        foreach ($this->studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('student_id', $eachstudent->id)->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)->get();
            if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->id] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($total_mark);
        $this->student = Student::where('id', $this->studentid)->where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->first();

        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->examid)
            ->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->studentid)->where('classmaster_id', $this->classmasterid)
                    ->where('section_id', $this->sectionid))->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();

        return view('livewire.admin.report.examreport.marksheetreportlivewire', compact('exam', 'examsubjectmark', 'grade', 'passpercentage', 'total_mark'));
    }
}
