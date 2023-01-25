<?php

namespace App\Http\Resources\Staff\Classattendance\Classattendancelist;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassattendancelistResource extends JsonResource
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
            'classmaster' => $this->classmaster->name,
            'section' => $this->section->name,
            'studentattendance_uuid' => $this->uuid,
        ];
    }
}
