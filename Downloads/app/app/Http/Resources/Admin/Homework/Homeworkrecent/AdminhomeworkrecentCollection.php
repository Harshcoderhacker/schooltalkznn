<?php

namespace App\Http\Resources\Admin\Homework\Homeworkrecent;

use App\Http\Resources\Admin\Homework\Homeworkrecent\AdminhomeworkrecentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminhomeworkrecentCollection extends ResourceCollection
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
            'homeworkrecentlist' => AdminhomeworkrecentResource::collection($this->collection),
        ];
    }
}
