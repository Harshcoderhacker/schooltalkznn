<?php

namespace App\Http\Resources\Admin\Class\Attendance\Staff;

use App\Http\Resources\Admin\Class\Attendance\Staff\ClassstaffabsentlistResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassstaffattendancedetailResource extends JsonResource
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
            'staffabsent_list' => ClassstaffabsentlistResource::collection($this->where('absent', true)),
        ];
    }
}
