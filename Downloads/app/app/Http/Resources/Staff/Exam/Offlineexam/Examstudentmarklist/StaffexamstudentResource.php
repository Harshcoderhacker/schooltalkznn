<?php

namespace App\Http\Resources\Staff\Exam\Offlineexam\Examstudentmarklist;

use App\Http\Resources\Staff\Exam\Offlineexam\Examstudentmarklist\StaffexamstudentmarklistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffexamstudentResource extends JsonResource
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
            'student_name' => $this->student->name,
            'total_mark' => $this->examstudentsubjectlist->sum('subjectmark_percentage'),
            'rank' => $this->findrank($this->student_id),
            'exam_details' => StaffexamstudentmarklistResource::collection($this->examstudentsubjectlist),
        ];
    }
}
