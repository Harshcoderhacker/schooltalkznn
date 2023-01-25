<?php

namespace App\Http\Resources\Staff\Exam\Onlineassessment\OAlist;

use App\Http\Resources\Staff\Exam\Onlineassessment\OAlist\StaffOAlistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffOAlistCollection extends ResourceCollection
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
            'OAlist' => StaffOAlistResource::collection($this->collection),
        ];
    }
}
