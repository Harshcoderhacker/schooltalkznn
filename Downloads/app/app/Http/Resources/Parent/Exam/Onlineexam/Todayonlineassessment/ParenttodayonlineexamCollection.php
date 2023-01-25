<?php

namespace App\Http\Resources\Parent\Exam\Onlineexam\Todayonlineassessment;

use App\Http\Resources\Parent\Exam\Online\Todayonlineassessment\ParenttodayonlineexamResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParenttodayonlineexamCollection extends ResourceCollection
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
            'onlineassement' => ParenttodayonlineexamResource::collection($this->collection),
        ];
    }
}
