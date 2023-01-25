<?php

namespace App\Http\Resources\Admin\Class\Classroutine;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $assingsubject = !$this->timetable->isEmpty() ? $this->timetable[0]->findclassinfo(request('weekday')) : null;
        return [
            'classroutine_name' => $this->name,
            'classroutine_time' => $this->start_time->format('g:ia') . ' - ' . $this->end_time->format('g:ia'),
            'classmaster' => $assingsubject ? $assingsubject->classmaster->name : "",
            'section' => $assingsubject ? $assingsubject->section->name : "",
            'subjectname' => $assingsubject ? $assingsubject->subject->name : "",
        ];
    }
}
