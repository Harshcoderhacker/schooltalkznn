<?php

namespace App\Http\Resources\Admin\Settings\Staffsettings\Staffdepartment;

use App\Http\Resources\Admin\Settings\Staffsettings\Staffdepartment\StaffdepartmentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffdepartmentCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'department_list' => StaffdepartmentResource::collection($this->collection),
        ];
    }
}
