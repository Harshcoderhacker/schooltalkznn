<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examstudentmarklist;

use Illuminate\Http\Resources\Json\JsonResource;

class ExamstudentmarklistResource extends JsonResource
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
            'subject_name' => $this->subject->name,
            'mark' => $this->subjectmark_percentage,
        ];
    }
}
