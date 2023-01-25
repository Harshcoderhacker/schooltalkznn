<?php

namespace App\Http\Livewire\Admin\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use Livewire\Component;
use Livewire\WithPagination;

class Onlineassessmentindexlivewire extends Component
{
    use WithPagination;
    public $paginationlength = 15;

    public function updatepagination()
    {
        $this->resetPage();
    }
    public function render()
    {
        $assessment = Onlineassessment::where('active', true)
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);
        return view('livewire.admin.exam.onlineassessment.onlineassessmentindexlivewire', compact('assessment'));
    }
}
