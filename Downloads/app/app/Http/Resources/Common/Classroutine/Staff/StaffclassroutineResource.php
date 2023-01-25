<?php

namespace App\Http\Resources\Common\Classroutine\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassroutineResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $assingsubject = !$this->stafftimetable->isEmpty() ? $this->stafftimetable[0]->findclassinfo(request('weekday')) : null;
        if ($assingsubject == null) {
            $substituteteacher = $this->stafftimetable[0]->staff->substitutor(request('weekday'), $this->id);
        }

        return [
            'classroutine_name' => $this->name,
            'classroutine_time' => $this->start_time->format('g:ia') . ' - ' . $this->end_time->format('g:ia'),
            'classmaster' => $assingsubject ? $assingsubject->classmaster->name : ($substituteteacher ? $substituteteacher->classmaster->name : ''),
            'section' => $assingsubject ? $assingsubject->section->name : ($substituteteacher ? $substituteteacher->section->name : ''),
            'subjectname' => $assingsubject ? $assingsubject->subject->name : ($substituteteacher ? 'Substitute' : ''),
        ];
    }
}
