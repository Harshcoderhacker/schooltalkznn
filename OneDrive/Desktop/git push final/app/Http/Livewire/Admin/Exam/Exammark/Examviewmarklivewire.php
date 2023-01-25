<?php

namespace App\Http\Livewire\Admin\Exam\Exammark;

use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use Livewire\Component;
use Livewire\WithPagination;

class Examviewmarklivewire extends Component
{
    use WithPagination;

    public $paginationlength = 10;
    public $exam_id, $examsubject, $subject_id, $marklist = [];

    public function mount($examid, $subjectid)
    {
        $this->exam_id = $examid;
        $this->subject_id = $subjectid;

    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $studentlist = Examstudentsubjectlist::with('examstudentlist.student')->where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)
            ->paginate($this->paginationlength)->onEachSide(1);

        $this->examsubject = Examsubject::where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)
            ->first();

        return view('livewire.admin.exam.exammark.examviewmarklivewire', compact('studentlist'));
    }
}
