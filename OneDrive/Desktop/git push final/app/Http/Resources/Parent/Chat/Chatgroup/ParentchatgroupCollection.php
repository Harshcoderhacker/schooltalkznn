<?php

namespace App\Http\Resources\Parent\Chat\Chatgroup;

use App\Http\Resources\Parent\Chat\Chatgroup\ParentchatgroupResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParentchatgroupCollection extends ResourceCollection
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
            'chatgroup' => ParentchatgroupResource::collection($this->collection),
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
