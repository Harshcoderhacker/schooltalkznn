<?php

namespace App\Http\Resources\Parent\Exam\Onlineexam\Assessmentanswer;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentOAstudentanswerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $student_answer;
        $correct_answer = "";
        if ($this->onlineassessmentquestion->answer == $this->answer) {
            if ($this->answer == 1) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_one : '';
                $correct_answer = "";
            }
            if ($this->answer == 2) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_two : '';
                $correct_answer = "";
            }
            if ($this->answer == 3) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_three : '';
                $correct_answer = "";
            }
            if ($this->answer == 4) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_four : '';
                $correct_answer = "";
            }
        } else {
            if ($this->answer == 1) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_one : '';
            }
            if ($this->answer == 2) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_two : '';
            }
            if ($this->answer == 3) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_three : '';
            }
            if ($this->answer == 4) {
                $student_answer = $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_four : '';
            }
            if ($this->onlineassessmentquestion->answer == 1) {
                $correct_answer = $this->onlineassessmentquestion->option_one;
            }
            if ($this->onlineassessmentquestion->answer == 2) {
                $correct_answer = $this->onlineassessmentquestion->option_two;
            }
            if ($this->onlineassessmentquestion->answer == 3) {
                $correct_answer = $this->onlineassessmentquestion->option_three;
            }
            if ($this->onlineassessmentquestion->answer == 4) {
                $correct_answer = $this->onlineassessmentquestion->option_four;
            }
        }

        return [
            'question' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->question : '',
            'option_one' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_one : '',
            'option_two' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_two : '',
            'option_three' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_three : '',
            'option_four' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->option_four : '',
            'remarks' => $correct_answer == "" ? 'You picked the right answer' : 'You picked the wrong answer',
            'answer' => $this->onlineassessmentquestion_id ? $this->onlineassessmentquestion->answer : '',
            'iscorrect' => $this->is_correct ? true : false,
            'student_answer' => $student_answer,
            'correct_answer' => $correct_answer,
        ];
    }
}
