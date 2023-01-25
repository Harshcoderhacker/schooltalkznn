<?php

namespace App\Http\Resources\Staff\Classinfo\Attendance;

use App\Http\Resources\Staff\Classinfo\Absentlist\StaffclassattendanceabsentlistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassstaffattendancedetailResource extends JsonResource
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
            'staffpresent_count' => $this->sum('present'),
            'totalstaff_count' => $this->count(),
            'staffabsent_list' => StaffclassattendanceabsentlistResource::collection($this->where('absent', true)),
        ];
    }
}
