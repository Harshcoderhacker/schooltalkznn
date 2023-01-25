<?php

namespace App\Http\Resources\Staff\Chat\Chatgroupfilter;

use App\Http\Resources\Staff\Chat\Chatgroupfilter\StaffchatgroupfilterResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class StaffchatgroupfilterCollection extends ResourceCollection
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
            'chatgroupfilter' => StaffchatgroupfilterResource::collection($this->collection),
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
