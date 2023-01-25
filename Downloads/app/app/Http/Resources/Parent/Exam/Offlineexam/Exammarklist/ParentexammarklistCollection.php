<?php

namespace App\Http\Resources\Parent\Exam\Offlineexam\Exammarklist;

use App\Http\Resources\Parent\Exam\Offlineexam\Exammarklist\ParentexammarklistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParentexammarklistCollection extends ResourceCollection
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
            'marksheets' => ParentexammarklistResource::collection($this->collection),
        ];
    }
}
