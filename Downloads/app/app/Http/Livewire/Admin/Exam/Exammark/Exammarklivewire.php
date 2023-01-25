<?php

namespace App\Http\Livewire\Admin\Exam\Exammark;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Exammarklivewire extends Component
{
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $section, $classmaster, $exam = [];

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

    public function render()
    {
        $examlist = Exam::with('examsubject')
            ->where('active', true)
            ->where(fn($query) => $query->where('classmaster_id', $this->classmaster_id))
            ->where(fn($query) => $query->whereJsonContains('section', $this->section_id))
            ->where(fn($query) => $query->where('id', $this->exam_id))
            ->latest()
            ->get();

        return view('livewire.admin.exam.exammark.exammarklivewire', compact('examlist'));
    }
}
