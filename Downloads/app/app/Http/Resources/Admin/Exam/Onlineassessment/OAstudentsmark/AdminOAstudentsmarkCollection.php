<?php

namespace App\Http\Resources\Admin\Exam\Onlineassessment\OAstudentsmark;

use App\Http\Resources\Admin\Exam\Onlineassessment\OAstudentsmark\AdminOAstudentsmarkResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminOAstudentsmarkCollection extends ResourceCollection
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
            'OAlist' => AdminOAstudentsmarkResource::collection($this->collection),
        ];
    }
}
