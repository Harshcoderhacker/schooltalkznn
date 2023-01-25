<?php

namespace App\Http\Livewire\Aparent\Exam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;
use Livewire\WithPagination;

class Parentexamindexlivewire extends Component
{

    use WithPagination;
    public $user;
    public $paginationlength = 10;
    public $examschedule;
    public $showexamschedulemodal = false;

    public function mount()
    {
        $this->user = Parenthelper::getstudentweb();
    }
    public function updatepagination()
    {
        $this->resetPage();
    }

    public function showexamschedule($exam_id)
    {
        $exam = Exam::find($exam_id);
        $this->examschedule = $exam->examsubject;
        $this->showexamschedulemodal = true;
    }

    public function examscheduleclosemodal()
    {
        $this->showexamschedulemodal = false;
    }

    public function render()
    {
        $exam = Exam::with('examsubject')
            ->where('academicyear_id', $this->user->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->whereJsonContains('section', (string) $this->user->section_id)
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.aparent.exam.parentexamindexlivewire', compact('exam'));
    }
}
