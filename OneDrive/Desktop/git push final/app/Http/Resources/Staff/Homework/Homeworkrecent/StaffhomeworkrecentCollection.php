<?php

namespace App\Http\Resources\Staff\Homework\Homeworkrecent;

use App\Http\Resources\Staff\Homework\Homeworkrecent\StaffhomeworkrecentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffhomeworkrecentCollection extends ResourceCollection
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
            'homeworkrecentlist' => StaffhomeworkrecentResource::collection($this->collection),
        ];
    }
}
