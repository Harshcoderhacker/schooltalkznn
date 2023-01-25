<?php

namespace App\Http\Resources\Staff\Homework\Homeworksubject;

use App\Http\Resources\Staff\Homework\Homeworksubject\StaffhomeworksubjectResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffhomeworksubjectCollection extends ResourceCollection
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
            'Homeworksubjectlist' => StaffhomeworksubjectResource::collection($this->collection),
        ];
    }
}
