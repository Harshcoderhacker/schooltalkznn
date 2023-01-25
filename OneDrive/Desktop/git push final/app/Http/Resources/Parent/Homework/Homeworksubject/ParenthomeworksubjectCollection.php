<?php

namespace App\Http\Resources\Parent\Homework\Homeworksubject;

use App\Http\Resources\Parent\Homework\Homeworksubject\ParenthomeworksubjectResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParenthomeworksubjectCollection extends ResourceCollection
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
            'subjectlist' => ParenthomeworksubjectResource::collection($this->collection),
        ];
    }
}
