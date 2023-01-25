<?php

namespace App\Http\Resources\Staff\Attendance;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffstudentattendancelistResource extends JsonResource
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
            'class_and_section' => ($this->classmaster ? $this->classmaster->name : '') . ' ' . ($this->section ? $this->section->name : ''),
            'attendance' => $this->present_count . '/' . $this->total_count,
            'absent_list' => $this->studentattendancelist->pluck('student.name'),
        ];
    }
}
