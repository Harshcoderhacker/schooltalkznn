<?php

namespace App\Http\Livewire\Admin\Settings\Logs\Loginlogs;

use App\Models\Miscellaneous\Logininfo;
use Livewire\Component;
use Livewire\WithPagination;

class Loginlogslivewire extends Component
{
    use WithPagination;

    public $created_at;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

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
        $loginlogs = Logininfo::query()
            ->where('user_name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.settings.logs.loginlogs.loginlogslivewire', compact('loginlogs'));
    }
}
