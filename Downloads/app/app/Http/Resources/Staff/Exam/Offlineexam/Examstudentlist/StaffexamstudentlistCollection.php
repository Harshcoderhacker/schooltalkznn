<?php

namespace App\Http\Resources\Staff\Exam\Offlineexam\Examstudentlist;

use App\Http\Resources\Staff\Exam\Offlineexam\Examstudentlist\StaffexamstudentlistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffexamstudentlistCollection extends ResourceCollection
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
            'Examstudentlist' => StaffexamstudentlistResource::collection($this->collection),
        ];
    }
}
