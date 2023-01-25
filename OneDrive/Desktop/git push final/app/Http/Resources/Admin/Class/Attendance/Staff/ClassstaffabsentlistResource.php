<?php

namespace App\Http\Resources\Admin\Class\Attendance\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassstaffabsentlistResource extends JsonResource
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
            'staff_name' => $this->name,
        ];
    }
}
