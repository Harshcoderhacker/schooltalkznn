<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examschedule;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminexamscheduleResource extends JsonResource
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
            'examsubject_name' => $this->subject_id ? $this->subject->name : '',
            'exam_date' => $this->examdate ? $this->examdate->format('d/m/Y') : '',
            'exam_start_time' => $this->start ? $this->start->format('g:ia') : '',
            'exam_end_time' => $this->end ? $this->end->format('g:ia') : '',
            'exam_mark' => $this->mark ? $this->mark : '',
        ];
    }
}
