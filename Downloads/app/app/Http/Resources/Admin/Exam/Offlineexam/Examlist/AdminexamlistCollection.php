<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examlist;

use App\Http\Resources\Admin\Exam\Offlineexam\Examlist\AdminexamResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminexamlistCollection extends ResourceCollection
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
            'Examlist' => AdminexamResource::collection($this->collection),
        ];
    }
}
