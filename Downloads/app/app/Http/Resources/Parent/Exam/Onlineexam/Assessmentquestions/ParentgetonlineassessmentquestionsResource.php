<?php

namespace App\Http\Resources\Parent\Exam\Onlineexam\Assessmentquestions;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentgetonlineassessmentquestionsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'assessment_uuid' => $this->onlineassessment_id ? $this->onlineassessment->uuid : '',
            'assessment_question_id' => $this->id ? $this->id : '',
            'assessment_question' => $this->question ? $this->question : '',
            'option_one' => $this->option_one ? $this->option_one : '',
            'option_two' => $this->option_two ? $this->option_two : '',
            'option_three' => $this->option_three ? $this->option_three : '',
            'option_four' => $this->option_four ? $this->option_four : '',
        ];
    }
}
