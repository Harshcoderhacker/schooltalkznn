<?php

namespace App\Http\Resources\Admin\Feed\Feedpost;

use App\Http\Resources\Admin\Feed\Feedpost\FeedpostResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class FeedpostCollection extends ResourceCollection
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
            'feedpost' => FeedpostResource::collection($this->collection),
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
