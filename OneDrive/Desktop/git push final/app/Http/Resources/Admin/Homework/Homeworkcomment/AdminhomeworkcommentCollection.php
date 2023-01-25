<?php

namespace App\Http\Resources\Admin\Homework\Homeworkcomment;

use App\Http\Resources\Admin\Homework\Homeworkcomment\AdminhomeworkcommentResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminhomeworkcommentCollection extends ResourceCollection
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
            'commentlist' => AdminhomeworkcommentResource::collection($this->collection),
            'pagination' => [
                'total' => $this->total(),
                'count' => $this->count(),
                'per_page' => $this->perPage(),
                'current_page' => $this->currentPage(),
                'total_pages' => $this->lastPage(),
            ],
        ];
    }
}
