<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Studentindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $classmasterid, $sectionid, $studentid;

    public $classmaster, $section;

    public $studentshowdata;

    public $isshowmodalopen = false;

    public $birthdaycount, $totalstudents;

    public function studentshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function studentclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->studentshowdata = [];
    }

    public function mount()
    {
        $today = Carbon::today();
        $count = 0;

        $this->birthdaycount = Student::whereMonth('dob', $today->month)
            ->whereDay('dob', $today->day)
            ->count();

        $this->totalstudents = Student::where('active', true)->count();

        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid && is_numeric($this->classmasterid)) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function show(student $student)
    {
        $this->studentshowdata = $student;
        $this->studentshowmodal();
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $student = Student::with('aparent')
            ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
            ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')
            ->where('roll_no', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.student.studentindexlivewire', compact('student'));
    }
}
