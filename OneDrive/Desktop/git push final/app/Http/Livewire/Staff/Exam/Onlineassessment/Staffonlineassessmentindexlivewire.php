<?php

namespace App\Http\Livewire\Staff\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use Livewire\Component;
use Livewire\WithPagination;

class Staffonlineassessmentindexlivewire extends Component
{
    use WithPagination;
    public $paginationlength = 15;
    public $user;

    public function mount()
    {
        $this->user = auth()->guard('staff')->user();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }
    public function render()
    {

        $assessment = Onlineassessment::where('active', true)
            ->whereIn('subject_id', $this->user->assignsubject->pluck('subject_id'))
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.staff.exam.onlineassessment.staffonlineassessmentindexlivewire', compact('assessment'));
    }
}
