<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examstudentmarklist;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamstudentResource extends JsonResource
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
            'exam_details' => ExamstudentmarklistResource::collection($this->examstudentsubjectlist),
        ];
    }
}
