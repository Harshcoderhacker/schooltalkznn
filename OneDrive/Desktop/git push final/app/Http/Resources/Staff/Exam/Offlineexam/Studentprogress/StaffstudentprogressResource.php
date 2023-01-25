<?php

namespace App\Http\Resources\Staff\Exam\Offlineexam\Studentprogress;

use App\Http\Resources\Staff\Exam\Offlineexam\Examstudentmarklist\StaffexamstudentmarklistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffstudentprogressResource extends JsonResource
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
            'exam_name' => $this->exam->name,
            'total_mark' => $this->examstudentsubjectlist->sum('subjectmark_percentage'),
            'rank' => $this->findrank($this->student_id),
            'exam_details' => StaffexamstudentmarklistResource::collection($this->examstudentsubjectlist),
        ];
    }
}
