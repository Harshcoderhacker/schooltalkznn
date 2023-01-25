<?php

namespace App\Http\Resources\Parent\Feed\Feedcommentreply;

use App\Http\Resources\Parent\Feed\Feedcommentreply\ParentfeedcommentreplyResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParentfeedcommentreplyCollection extends ResourceCollection
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
            'feedpostcommentreply' => ParentfeedcommentreplyResource::collection($this->collection),
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
