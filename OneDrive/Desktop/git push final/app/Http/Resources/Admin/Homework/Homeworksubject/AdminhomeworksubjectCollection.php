<?php

namespace App\Http\Resources\Admin\Homework\Homeworksubject;

use App\Http\Resources\Admin\Homework\Homeworksubject\AdminhomeworksubjectResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminhomeworksubjectCollection extends ResourceCollection
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
            'Homeworksubjectlist' => AdminhomeworksubjectResource::collection($this->collection),
        ];
    }
}
