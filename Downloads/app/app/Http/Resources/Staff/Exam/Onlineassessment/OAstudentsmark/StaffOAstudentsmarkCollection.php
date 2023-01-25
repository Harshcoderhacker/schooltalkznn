<?php

namespace App\Http\Resources\Staff\Exam\Onlineassessment\OAstudentsmark;

use App\Http\Resources\Staff\Exam\Onlineassessment\OAstudentsmark\StaffOAstudentsmarkResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffOAstudentsmarkCollection extends ResourceCollection
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
            'OAlist' => StaffOAstudentsmarkResource::collection($this->collection),
        ];
    }
}
