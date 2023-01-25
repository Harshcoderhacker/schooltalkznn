<?php

namespace App\Http\Livewire\Aparent\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Parent\Parenthelper\Parenthelper;
use Carbon\Carbon;
use Livewire\Component;

class Parentonlineassessmentsummarylivewire extends Component
{
    public $onlineassessment_id, $onlineassessment, $onlineassessmentstudentlist, $user;
    public $current_question = 0;
    public $completion = false;
    public $start_time, $end_time;
    public function mount($onlineassessment_id)
    {
        $this->start_time = Carbon::now();
        $this->user = Parenthelper::getstudentweb();
        $this->onlineassessment_id = $onlineassessment_id;
        $this->onlineassessmentstudentlist = Onlineassessmentstudentlist::where('onlineassessment_id', $this->onlineassessment_id)->where('student_id', $this->user->id)->first();
    }

    public function nextquestion()
    {
        $this->current_question += 1;
    }

    public function previousquestion()
    {
        $this->current_question -= 1;
    }

    public function submitassessment()
    {
        $this->end_time = Carbon::now();
        $time_taken = $this->start_time->diff($this->end_time);
        $this->onlineassessmentstudentlist->update([
            'assessment_status' => 1,
            'participated_date' => Carbon::today(),
            'start_time' => $this->start_time->format('H:i:s'),
            'end_time' => $this->end_time->format('H:i:s'),
            'time_taken' => $time_taken->format('%h:%i:%s'),
        ]);
        $this->completion = true;
        $this->dispatchBrowserEvent('successtoast', ['message' => 'Exam Completed Successfully!']);
    }

    public function render()
    {
        $this->onlineassessment = Onlineassessment::find($this->onlineassessment_id);
        return view('livewire.aparent.exam.onlineassessment.parentonlineassessmentsummarylivewire');
    }
}
