<?php

namespace App\Http\Resources\Admin\Exam\Onlineassessment\OAlist;

use App\Http\Resources\Admin\Exam\Onlineassessment\OAlist\AdminOAlistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminOAlistCollection extends ResourceCollection
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
            'OAlist' => AdminOAlistResource::collection($this->collection),
        ];
    }
}
