<?php

namespace App\Http\Resources\Admin\Settings\Staffsettings\Staffdesignation;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffdesignationResource extends JsonResource
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
            'designation_uuid' => $this->uuid ? $this->uuid : '',
            'designation_name' => $this->name ? $this->name : '',
        ];
    }
}
