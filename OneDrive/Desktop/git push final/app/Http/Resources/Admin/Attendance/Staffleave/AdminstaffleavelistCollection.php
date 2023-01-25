<?php

namespace App\Http\Resources\Admin\Attendance\Staffleave;

use App\Http\Resources\Admin\Attendance\Staffleave\AdminstaffleavelistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminstaffleavelistCollection extends ResourceCollection
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
            'staffleavelist' => AdminstaffleavelistResource::collection($this->collection),
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
