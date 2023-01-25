<?php

namespace App\Http\Livewire\Admin\Report\Examreport;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentprogressreportlivewire extends Component
{
    public $classmasterid, $sectionid, $studentid, $examid;

    public $classmaster, $section = [], $studentlist = [], $examlist = [];

    public $section_name;

    public $student;

    public $downloadtype, $month_string;

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
        $this->studentid = '';
        if ($this->classmasterid && $this->sectionid) {
            $this->studentlist = Student::where('academicyear_id', $this->academicyear_id)
                ->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();
            $this->section_name = Section::find($this->sectionid)->name;
        } else {
            $this->studentlist = [];
        }
    }

    public function downloadstudentprogressreport()
    {
        $section_name = $this->section_name;
        $student = Student::where('id', $this->studentid)->where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->first();
        $exam = Exam::with('examsubject')->where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->classmasterid)
            ->whereJsonContains('section', (string) $this->sectionid)
            ->get();

        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();

        $pdf = Pdf::loadView('admin.report.examreport.pdf.studentprogressreport', compact('exam', 'grade', 'passpercentage', 'section_name', 'student'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Evaluation Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Studentprogressreport.pdf');
    }

    public function render()
    {
        $this->student = Student::where('id', $this->studentid)->where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->first();

        $exam = Exam::with('examsubject')->where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->classmasterid)
            ->whereJsonContains('section', (string) $this->sectionid)
            ->get();

        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();
        return view('livewire.admin.report.examreport.studentprogressreportlivewire', compact('exam', 'grade', 'passpercentage'));
    }
}
