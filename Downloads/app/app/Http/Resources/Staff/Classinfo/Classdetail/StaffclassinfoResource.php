<?php

namespace App\Http\Resources\Staff\Classinfo\Classdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassinfoResource extends JsonResource
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
            'staff_name' => $this->staff->name,
            'subject_name' => $this->subject->name,
        ];
    }
}
