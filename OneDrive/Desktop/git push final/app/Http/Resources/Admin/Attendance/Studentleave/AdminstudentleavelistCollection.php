<?php

namespace App\Http\Resources\Admin\Attendance\Studentleave;

use App\Http\Resources\Admin\Attendance\Studentleave\AdminstudentleavelistResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AdminstudentleavelistCollection extends ResourceCollection
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
            'studentleavelist' => AdminstudentleavelistResource::collection($this->collection),
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
