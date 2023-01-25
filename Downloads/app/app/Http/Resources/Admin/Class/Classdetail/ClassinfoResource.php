<?php

namespace App\Http\Resources\Admin\Class\Classdetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassinfoResource extends JsonResource
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
