<?php

namespace App\Http\Livewire\Aparent\Homework;

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;
use Livewire\WithPagination;

class Aparenthomeworkindexlivewire extends Component
{
    use WithPagination;

    public $user;
    public $paginationlength = 10;
    public $assignsubject_id, $subjects = [];

    public function mount()
    {
        $this->user = Parenthelper::getstudentweb();
        $this->subjects = Assignsubject::where('classmaster_id', $this->user->classmaster_id)
            ->where('section_id', $this->user->section_id)->get();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {

        $homework = Homework::with(['homeworklist' => fn($q) => $q->where('student_id', $this->user->id)])
            ->where('academicyear_id', $this->user->academicyear_id)
            ->where('classmaster_id', $this->user->classmaster_id)
            ->where('section_id', $this->user->section_id)
            ->where(fn($query) => ($this->assignsubject_id) ? $query->where('assignsubject_id', $this->assignsubject_id) : '')
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.aparent.homework.aparenthomeworkindexlivewire', compact('homework'));
    }
}
