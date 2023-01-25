<?php

namespace App\Http\Livewire\Admin\Report\Examreport;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Examsetting\Examgrade;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Classprogressreportlivewire extends Component
{
    public $classmasterid, $sectionid, $examid, $section_name;
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
            $this->section = [];
        }
    }

    public function updatedSectionid()
    {
        if ($this->classmasterid && $this->sectionid) {
            $this->section_name = Section::find($this->sectionid)->name;
        }
    }

    public function downloadclassprogressreport()
    {
        $section_name = $this->section_name;
        $student = Student::where('active', true)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        $exam = Exam::with('examsubject')->where('active', true)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->classmasterid)
            ->whereJsonContains('section', (string) $this->sectionid)
            ->get();
        $examsubjectmark = Examstudentlist::with('examstudentsubjectlist')
            ->whereHas('exam', fn($q) =>
                $q->where('is_main_exam', true)
                    ->where('classmaster_id', $this->classmasterid)
                    ->whereJsonContains('section', (string) $this->sectionid))
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();

        $pdf = Pdf::loadView('admin.report.examreport.pdf.classprogressreport', compact('exam', 'section_name', 'grade', 'passpercentage', 'examsubjectmark'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Evaluation Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Classprogressreport.pdf');
    }

    public function render()
    {
        $student = Student::where('active', true)->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        $exam = Exam::with('examsubject')->where('active', true)
            ->where('is_main_exam', true)
            ->where('classmaster_id', $this->classmasterid)
            ->whereJsonContains('section', (string) $this->sectionid)
            ->get();
        $examsubjectmark = Examstudentlist::with('examstudentsubjectlist')
            ->whereHas('exam', fn($q) =>
                $q->where('is_main_exam', true)
                    ->where('classmaster_id', $this->classmasterid)
                    ->whereJsonContains('section', (string) $this->sectionid))
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)->get();
        $grade = Examgrade::where('active', true)->get();
        $passpercentage = Exampasspercentage::where('active', true)->get();
        return view('livewire.admin.report.examreport.classprogressreportlivewire', compact('exam', 'grade', 'passpercentage', 'examsubjectmark'));
    }
}
