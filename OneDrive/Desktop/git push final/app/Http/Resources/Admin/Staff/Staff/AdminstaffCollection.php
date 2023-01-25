<?php

namespace App\Http\Resources\Admin\Staff\Staff;

use App\Http\Resources\Admin\Staff\Staff\AdminstaffResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminstaffCollection extends ResourceCollection
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
            'staff_list' => AdminstaffResource::collection($this->collection),
        ];
    }
}
