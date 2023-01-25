<?php

namespace App\Http\Resources\Admin\Settings\Staffsettings\Staffdesignation;

use App\Http\Resources\Admin\Settings\Staffsettings\Staffdesignation\StaffdesignationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffdesignationCollection extends ResourceCollection
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
            'designation_list' => StaffdesignationResource::collection($this->collection),
        ];
    }
}
