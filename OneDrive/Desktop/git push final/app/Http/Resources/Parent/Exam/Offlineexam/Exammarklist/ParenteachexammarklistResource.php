<?php

namespace App\Http\Resources\Parent\Exam\Offlineexam\Exammarklist;

use Illuminate\Http\Resources\Json\JsonResource;

class ParenteachexammarklistResource extends JsonResource
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
            'exam_uuid' => $this->uuid ? $this->uuid : '',
            'exam_name' => $this->name ? $this->name : '',
            'exam_dates' => $this->examsubject->count() > 1 ? $this->examsubject->min('examdate')->format('F d') . " to " . $this->examsubject->max('examdate')->format('d, Y') : $this->examsubject[0]->examdate->format('F d, Y'),
            'subject_count' => $this->count(),
            'average' => $this->examstudentsubjectlist->avg('subject_percentage') ? $this->examstudentsubjectlist->avg('subject_percentage') : '',
        ];
    }
}
