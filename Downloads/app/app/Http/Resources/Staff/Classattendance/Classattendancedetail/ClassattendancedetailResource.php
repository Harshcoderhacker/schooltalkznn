<?php

namespace App\Http\Resources\Staff\Classattendance\Classattendancedetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassattendancedetailResource extends JsonResource
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
            'studentpresent_count' => $this->presentstudent->count(),
            'studentabsent_count' => $this->absentstudent->count(),
            'studenthalfday_count' => $this->halfdaystudent->count(),
            'studentlate_count' => $this->latestudent->count(),
            'studentabsent_list' => ClassattendancedeabsentlistResource::collection($this->absentstudent),
        ];
    }
}
