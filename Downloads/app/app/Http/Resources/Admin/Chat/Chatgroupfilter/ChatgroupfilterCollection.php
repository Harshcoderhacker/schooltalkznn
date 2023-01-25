<?php

namespace App\Http\Resources\Admin\Chat\Chatgroupfilter;

use App\Http\Resources\Admin\Chat\Chatgroupfilter\ChatgroupfilterResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ChatgroupfilterCollection extends ResourceCollection
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
            'chatgroupfilter' => ChatgroupfilterResource::collection($this->collection),
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
