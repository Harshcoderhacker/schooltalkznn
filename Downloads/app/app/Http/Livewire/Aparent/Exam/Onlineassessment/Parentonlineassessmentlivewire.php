<?php

namespace App\Http\Livewire\Aparent\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Parent\Parenthelper\Parenthelper;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class Parentonlineassessmentlivewire extends Component
{
    use WithPagination;
    public $user, $panel, $today;
    public $paginationlength = 10;

    public function mount($panel)
    {
        $this->today = Carbon::today();
        $this->user = Parenthelper::getstudentweb();
        $this->panel = $panel;
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $onlineassessment = null;
        if ($this->panel == "onlive") {
            $onlineassessment = Onlineassessment::where('academicyear_id', $this->user->academicyear_id)
                ->where(function ($query) {
                    $query->where('assigntype', 1)
                        ->orwhere(function ($query) {
                            $query->whereDate('start_date', '<=', $this->today)
                                ->whereDate('end_date', '>=', $this->today);
                        });
                })
                ->whereHas('onlineassessmentstudentlist', fn($q) => $q->where('student_id', $this->user->id)->where('assessment_status', 0))
                ->where('classmaster_id', $this->user->classmaster_id)
                ->whereJsonContains('section', (string) $this->user->section_id)
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);
        } elseif ($this->panel == "upcoming") {
            $onlineassessment = Onlineassessment::where('academicyear_id', $this->user->academicyear_id)
                ->whereDate('start_date', '>', $this->today)
                ->where('classmaster_id', $this->user->classmaster_id)
                ->whereJsonContains('section', (string) $this->user->section_id)
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);
        } else {
            $onlineassessmentcompleted_id = collect(Onlineassessmentstudentlist::where('student_id', $this->user->id)->where('classmaster_id', $this->user->classmaster_id)
                    ->where('section_id', $this->user->section_id)
                    ->where('assessment_status', 1)->pluck('onlineassessment_id'))->toArray();

            $onlineassessment = Onlineassessment::whereIn('id', $onlineassessmentcompleted_id)
                ->with(['onlineassessmentstudentlist' => function ($query) {
                    $query->where('student_id', $this->user->id);
                }])
                ->where('academicyear_id', $this->user->academicyear_id)
                ->whereIn('id', $onlineassessmentcompleted_id)
                ->orwhereDate('start_date', '<', $this->today)
                ->where('classmaster_id', $this->user->classmaster_id)
                ->whereJsonContains('section', (string) $this->user->section_id)
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);
        }
        return view('livewire.aparent.exam.onlineassessment.parentonlineassessmentlivewire', compact('onlineassessment'));
    }
}
