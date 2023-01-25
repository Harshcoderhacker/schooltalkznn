<?php

namespace App\Http\Livewire\Admin\Accounts\Feewaived;

use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use Livewire\Component;
use Livewire\WithPagination;

class Feewaivedindexlivewire extends Component
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
        $studentfeewaivedlist = Feestudentpayment::with('student')
            ->where('discount_amount', '<>', 0)
            ->whereHas('student', fn($query) =>
                $query->where('name', 'like', '%' . $this->searchTerm . '%')
            )
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.accounts.feewaived.feewaivedindexlivewire', ['studentfeewaivedlist' => $studentfeewaivedlist]);
    }
}
