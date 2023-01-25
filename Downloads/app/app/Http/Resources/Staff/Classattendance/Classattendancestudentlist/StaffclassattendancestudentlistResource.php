<?php

namespace App\Http\Resources\Staff\Classattendance\Classattendancestudentlist;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassattendancestudentlistResource extends JsonResource
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
            'roll_no' => $this->student ? $this->student->roll_no : "",
            'student_name' => $this->student ? $this->student->name : "",
            'present' => $this->present == 1 ? true : false,
            'late' => $this->late == 1 ? true : false,
            'absent' => $this->absent == 1 ? true : false,
            'halfday' => $this->halfday == 1 ? true : false,
            'studentattendancelist_uuid' => $this->uuid,
        ];
    }
}
