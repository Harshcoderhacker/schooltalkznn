<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Studentprogress;

use App\Http\Resources\Admin\Exam\Offlineexam\Examstudentmarklist\ExamstudentmarklistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminstudentprogressResource extends JsonResource
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
            'exam_details' => ExamstudentmarklistResource::collection($this->examstudentsubjectlist),
        ];
    }
}
