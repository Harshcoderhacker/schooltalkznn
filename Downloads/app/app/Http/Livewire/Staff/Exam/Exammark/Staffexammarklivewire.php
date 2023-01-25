<?php

namespace App\Http\Livewire\Staff\Exam\Exammark;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Livewire\WithPagination;

class Staffexammarklivewire extends Component
{

    use WithPagination;
    public $paginationlength = 10;
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $section, $classmaster, $exam = [];

    public function mount()
    {
        $this->user = auth()->guard('staff')->user();

        $this->classteacher = Assignsubject::where('staff_id', $this->user->id)
            ->where('is_classteacher', true)
            ->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
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

    public function render()
    {
        if (!$this->classmaster_id) {
            $this->section_id = '';
            $this->exam = [];
        }
        $examlist = Exam::with('examsubject')
            ->where(fn ($query) => $query->where('classmaster_id', $this->classmaster_id))
            ->where(fn ($query) => $query->whereJsonContains('section', $this->section_id))
            ->where(fn ($query) => $query->where('id', $this->exam_id))
            ->latest()
            ->get();

        return view('livewire.staff.exam.exammark.staffexammarklivewire', compact('examlist'));
    }
}
