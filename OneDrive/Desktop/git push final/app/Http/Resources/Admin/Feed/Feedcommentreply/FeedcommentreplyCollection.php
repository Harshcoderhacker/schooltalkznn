<?php

namespace App\Http\Resources\Admin\Feed\Feedcommentreply;

use App\Http\Resources\Admin\Feed\Feedcommentreply\FeedcommentreplyResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FeedcommentreplyCollection extends ResourceCollection
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
            'feedpostcommentreply' => FeedcommentreplyResource::collection($this->collection),
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
