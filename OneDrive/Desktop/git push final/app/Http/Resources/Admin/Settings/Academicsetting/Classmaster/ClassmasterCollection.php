<?php

namespace App\Http\Resources\Admin\Settings\Academicsetting\Classmaster;

use App\Http\Resources\Admin\Settings\Academicsetting\Classmaster\ClassmasterResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ClassmasterCollection extends ResourceCollection
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
            'class_list' => ClassmasterResource::collection($this->collection),
        ];
    }
}
