<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examstudentlist;

use App\Http\Resources\Admin\Exam\Offlineexam\Examstudentlist\AdminexamstudentlistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminexamstudentlistCollection extends ResourceCollection
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
            'Examstudentlist' => AdminexamstudentlistResource::collection($this->collection),
        ];
    }
}
