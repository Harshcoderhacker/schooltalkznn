<?php

namespace App\Http\Resources\Admin\Attendance;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminstaffattendancelistResource extends JsonResource
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
            'designation' => ($this->staffdesignation ? $this->staffdesignation->name : ''),
            'attendance' => $this->present_count . '/' . $this->total_count,
            'absent_list' => $this->staffattendancelist->pluck('staff.name'),
        ];
    }
}
