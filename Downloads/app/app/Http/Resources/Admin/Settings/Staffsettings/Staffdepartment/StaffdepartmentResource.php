<?php

namespace App\Http\Resources\Admin\Settings\Staffsettings\Staffdepartment;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffdepartmentResource extends JsonResource
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
            'department_uuid' => $this->uuid ? $this->uuid : '',
            'department_name' => $this->name ? $this->name : '',
        ];
    }
}
