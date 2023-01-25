<?php

namespace App\Http\Livewire\Admin\Report\Examreport;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Classreportlivewire extends Component
{
    public $classmasterid, $sectionid, $examid;
    public $classmaster, $section = [], $student = [], $examlist = [];

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
            $this->student = [];
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
            $this->student = [];
        }
    }

    public function downloadclassreport()
    {
        $total_mark = [];
        $avg = 0;
        $total_avg = [];
        $allexamattendance = [];
        $examattendance = 0;
        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        foreach ($examsubjectmark as $key => $eachstudent) {
            if (sizeof($eachstudent->examstudentsubjectlist) == $eachstudent->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->student_id] = $eachstudent->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($total_mark);
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();
        $section_name = $this->section_name;
        if ($exam->isNotEmpty()) {

            foreach ($exam[0]->examsubject as $key => $eachsubject) {
                $allexamattendance[$key] = $eachsubject->attendance_percentage;
            }
            if (array_sum($allexamattendance) != 0) {

                $examattendance = round(array_sum($allexamattendance) / count($allexamattendance));
            }
        }

        foreach ($examsubjectmark as $key => $eachexamsubjectmark) {
            $total_avg[$key] = round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100);
        }
        if (array_sum($total_avg) != 0) {
            $avg = round(array_sum($total_avg) / count($total_avg));
        }

        $pdf = Pdf::loadView('admin.report.examreport.pdf.classreport', compact('exam', 'section_name', 'examsubjectmark', 'examattendance', 'avg', 'grade', 'passpercentage', 'total_mark'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Evaluation Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Classreport.pdf');
    }

    public function render()
    {
        $total_mark = [];
        $avg = 0;
        $total_avg = [];
        $allexamattendance = [];
        $examattendance = 0;
        $exam = Exam::with('examsubject')->where('academicyear_id', $this->academicyear_id)->where('id', $this->examid)
            ->get();
        $examsubjectmark = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->examid)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        foreach ($examsubjectmark as $key => $eachstudent) {
            if (sizeof($eachstudent->examstudentsubjectlist) == $eachstudent->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->student_id] = $eachstudent->examstudentsubjectlist->sum('mark');
            }
        }
        arsort($total_mark);
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();

        if ($exam->isNotEmpty()) {

            foreach ($exam[0]->examsubject as $key => $eachsubject) {
                $allexamattendance[$key] = $eachsubject->attendance_percentage;
            }
            if (array_sum($allexamattendance) != 0) {

                $examattendance = round(array_sum($allexamattendance) / count($allexamattendance));
            }
        }

        foreach ($examsubjectmark as $key => $eachexamsubjectmark) {
            $total_avg[$key] = round(($eachexamsubjectmark->examstudentsubjectlist->sum('mark') / $exam[0]->examsubject->sum('mark')) * 100);
        }
        if (array_sum($total_avg) != 0) {
            $avg = round(array_sum($total_avg) / count($total_avg));
        }
        return view('livewire.admin.report.examreport.classreportlivewire', compact('exam', 'examsubjectmark', 'examattendance', 'avg', 'grade', 'passpercentage', 'total_mark'));
    }
}
