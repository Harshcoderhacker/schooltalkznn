<?php

namespace App\Http\Resources\Staff\Exam\Offlineexam\Examlist;

use App\Http\Resources\Staff\Exam\Offlineexam\Examlist\StaffexamResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffexamlistCollection extends ResourceCollection
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
            'Examlist' => StaffexamResource::collection($this->collection),
        ];
    }
}
