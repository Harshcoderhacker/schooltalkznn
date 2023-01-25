<?php

namespace App\Http\Livewire\Admin\Accounts\Feedue;

use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Feedueindexlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $classmasterid, $sectionid, $studentid, $feemasterid;

    public $classmaster, $section, $feemaster;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->feemaster = Feemaster::where('active', true)->get();
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
        $studentfeeduelist = Student::with('feeduestudent', 'feeduestudent.feemaster')
            ->isaccountactive()
            ->whereHas('feeassignstudent', function (Builder $query) {
                $query->where('is_selected', true);
                $query->where('due_amount', '!=', 0);
            })
            ->whereHas('feeduestudent.feemaster', fn($query) =>
                ($this->feemasterid) ? $query->where('id', $this->feemasterid) : '')
            ->where(fn($query) => ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '')
            ->where(fn($query) => ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '')
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.accounts.feedue.feedueindexlivewire', ['studentfeeduelist' => $studentfeeduelist]);
    }
}
