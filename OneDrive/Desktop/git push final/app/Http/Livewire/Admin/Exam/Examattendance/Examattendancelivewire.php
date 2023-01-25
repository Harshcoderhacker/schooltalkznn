<?php

namespace App\Http\Livewire\Admin\Exam\Examattendance;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Examattendancelivewire extends Component
{
    public $today;
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $section, $classmaster, $exam_info, $examsubject, $exam = [];
    public $showstudentattendance, $openattendance = false;

    public function mount()
    {
        $this->today = Carbon::today();
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->exam = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function updatedClassmasterid()
    {
        $this->section_id = '';
        if ($this->classmaster_id && is_numeric($this->classmaster_id)) {
            $this->section = Classmaster::find($this->classmaster_id)->section;
        } else {
            $this->section = [];
            $this->exam = [];
        }
    }

    public function updatedSectionid()
    {
        $this->exam_id = '';
        if ($this->section_id && is_numeric($this->section_id)) {
            $this->exam = Exam::where('academicyear_id', $this->academicyear_id)
                ->where('classmaster_id', $this->classmaster_id)
                ->whereJsonContains('section', $this->section_id)->get();
        } else {
            $this->exam = [];
        }
    }

    public function closeattendancemodal()
    {
        $this->showstudentattendance = null;
        $this->openattendance = false;
    }

    public function showattendancemodel($exam_id, $subject_id)
    {
        $studentattendance = Examstudentsubjectlist::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->get();
        $this->exam_info = Exam::where('id', $exam_id)->first();
        $this->examsubject = Examsubject::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->first();
        $this->showstudentattendance = $studentattendance;
        $this->openattendance = true;
    }

    public function render()
    {
        $examlist = Exam::with('examsubject')
            ->where(fn($query) => $query->where('classmaster_id', $this->classmaster_id))
            ->where(fn($query) => $query->whereJsonContains('section', $this->section_id))
            ->where(fn($query) => $query->where('id', $this->exam_id))
            ->latest()
            ->get();

        return view('livewire.admin.exam.examattendance.examattendancelivewire', compact('examlist'));
    }
}
