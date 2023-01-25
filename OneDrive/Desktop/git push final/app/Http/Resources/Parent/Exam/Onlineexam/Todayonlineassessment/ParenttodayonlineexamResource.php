<?php

namespace App\Http\Resources\Parent\Exam\Onlineexam\Todayonlineassessment;

use Illuminate\Http\Resources\Json\JsonResource;

class ParenttodayonlineexamResource extends JsonResource
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
            'assessment_name' => $this->onlineassessment_id ? $this->onlineassessment->name : '',
            'subject' => $this->onlineassessment_id ? $this->onlineassessment->subject->name : '',
            'no_of_questions' => $this->onlineassessment_id ? $this->onlineassessment->onlineassessmentquestion->count() : '',
            'image' => $this->onlineassessment_id ? 'storage/onlineassessment/' . $this->onlineassessment->image : '',
            'mark' => $this->mark ? $this->mark . ' / ' . $this->onlineassessment->total_mark : '0 / ' . $this->onlineassessment->total_mark,
            'assessment_status' => $this->assessment_status == 0 ? true : false,
        ];
    }
}
