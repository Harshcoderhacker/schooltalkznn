<?php

namespace App\Http\Livewire\Admin\Exam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Examindexlivewire extends Component
{
    use WithPagination;
    public $paginationlength = 10;
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $section, $classmaster, $exam = [];
    public $openattendance = false, $openmarkmodel = false;
    public $examsubject, $showstudentattendance, $showstudentmark, $examsubjectmark;

    public function mount()
    {
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
                ->whereJsonContains('section', $this->section_id)
                ->get();
        } else {
            $this->exam = [];
        }
    }

    public function showattendancemodel($exam_id, $subject_id)
    {
        $this->showstudentattendance = Examstudentsubjectlist::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->get();
        $this->examsubject = Examsubject::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->first();
        $this->openattendance = true;
    }

    public function closeattendancemodal()
    {
        $this->showstudentattendance = null;
        $this->openattendance = false;
    }
    public function showmarkmodel($exam_id, $subject_id)
    {
        $this->showstudentmark = Examstudentsubjectlist::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->get();
        $this->examsubjectmark = Examsubject::where('exam_id', $exam_id)
            ->where('subject_id', $subject_id)->first();
        $this->openmarkmodel = true;
    }

    public function closemarkmodal()
    {
        $this->showstudentmark = null;
        $this->openmarkmodel = false;
    }

    public function render()
    {
        $examlist = Exam::with('examsubject')
            ->where('academicyear_id', $this->academicyear_id)
            ->where(fn($query) => $query->where('classmaster_id', $this->classmaster_id))
            ->where(fn($query) => $query->whereJsonContains('section', $this->section_id))
            ->where(fn($query) => $query->where('id', $this->exam_id))
            ->latest()
            ->get();

        return view('livewire.admin.exam.examindexlivewire', compact('examlist'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_fee_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
