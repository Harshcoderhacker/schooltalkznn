<?php

namespace App\Http\Livewire\Aparent\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentanswer;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;

class Parenttakeonlineassessmentlivewire extends Component
{
    public $user, $onlineassessmentquestion;
    public $questionno;
    public $answer;

    public function mount(Onlineassessmentquestion $onlineassessmentquestion, $questionno)
    {
        $this->user = Parenthelper::getstudentweb();
        $this->onlineassessmentquestion = $onlineassessmentquestion;
        $this->questionno = $questionno;
    }

    public function markanswer($answer)
    {
        $onlineassessmentstudentlist = Onlineassessmentstudentlist::where('student_id', $this->user->id)->where('onlineassessment_id', $this->onlineassessmentquestion->onlineassessment_id)->first();
        $this->answer = $answer;
        $onlineassessmentstudentanswer = Onlineassessmentstudentanswer::updateOrCreate([
            'onlineassessment_id' => $this->onlineassessmentquestion->onlineassessment_id,
            'onlineassessmentquestion_id' => $this->onlineassessmentquestion->id,
            'onlineassessmentstudentlist_id' => $onlineassessmentstudentlist->id,
            'student_id' => $this->user->id,
        ], [
            'answer' => $answer,
            'is_correct' => $this->onlineassessmentquestion->answer == $answer ? 1 : 0,
        ]);
        $onlineassessmentstudentlist->update([
            'mark' => ($onlineassessmentstudentanswer->where('student_id', $this->user->id)
                    ->where('onlineassessment_id', $this->onlineassessmentquestion->onlineassessment_id)
                    ->where('is_correct', true)
                    ->count() * config('archive.online_assessment.mark'))]);
    }

    public function render()
    {
        return view('livewire.aparent.exam.onlineassessment.parenttakeonlineassessmentlivewire');
    }
}
