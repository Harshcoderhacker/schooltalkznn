<?php

namespace App\Http\Livewire\Staff\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Section;
use Livewire\Component;

class Staffassessmentsummarylivewire extends Component
{public $nonparticipantmodel = false;
    public $openanswermodel = false;
    public $onlineassessment_id, $section_name, $studentanswer;

    public function mount($assessmentid)
    {
        $this->onlineassessment_id = $assessmentid;

    }
    public function shownonparticipantmodel()
    {
        $this->nonparticipantmodel = true;
    }

    public function closenonparticipantmodel()
    {
        $this->nonparticipantmodel = false;
    }

    public function showanswermodel(Onlineassessmentstudentlist $onlineassessmentstudentlist)
    {
        $this->studentanswer = $onlineassessmentstudentlist;
        $this->openanswermodel = true;
    }

    public function closeanswermodel()
    {
        $this->openanswermodel = false;
    }

    public function render()
    {
        $onlineassessment = Onlineassessment::find($this->onlineassessment_id);
        $this->section_name = Section::whereIn('id', $onlineassessment->section)->pluck('name')->implode(', ');
        return view('livewire.staff.exam.onlineassessment.staffassessmentsummarylivewire', compact('onlineassessment'));
    }
}
