<?php

namespace App\Http\Resources\Staff\Classinfo\Attendance;

use App\Http\Resources\Staff\Classinfo\Absentlist\StudentclassattendanceabsentlistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassstudentattendancedetailResource extends JsonResource
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
            'studentpresent_count' => isset($this->presentstudent) ? $this->presentstudent->count() : 0,
            'totalstudent_count' => isset($this->studentattendancelist) ? $this->studentattendancelist->count() : 0,
            'studentabsent_list' => isset($this->studentattendancelist) ? StudentclassattendanceabsentlistResource::collection($this->absentstudent) : [],
        ];
    }
}
