<?php

namespace App\Http\Resources\Admin\Staff\Staff;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminstaffResource extends JsonResource
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
            'staff_uuid' => $this->uuid ? $this->uuid : '',
            'staff_name' => $this->name ? $this->name : '',
        ];
    }
}
