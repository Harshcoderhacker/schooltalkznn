<?php

namespace App\Http\Resources\Staff\Exam\Onlineassessment\OAlist;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffOAlistResource extends JsonResource
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
            'assessment_uuid' => $this->uuid ? $this->uuid : '',
            'assessment_name' => $this->name ? $this->name : '',
            'classmaster_name' => $this->classmaster_id ? $this->classmaster->name : '',
            'subject_name' => $this->subject_id ? $this->subject->name : '',
            'start_date' => $this->start_date ? $this->start_date->format('d/m/Y') : '',
            'end_date' => $this->end_date ? $this->end_date->format('d/m/Y') : '',
            'status' => $this->assigntype == 1 ? 'Always Active' : '',
            'mark' => $this->total_mark ? $this->total_mark : '',
            'total_questions' => $this->onlineassessmentquestion->count('question'),
            'students_attended_count' => $this->onlineassessmentstudentlist->where('assessment_status', 1)->count(),
            'students_not_attended' => $this->onlineassessmentstudentlist->where('assessment_status', 0)->count(),
        ];
    }
}
