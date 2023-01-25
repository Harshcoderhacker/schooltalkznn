<?php

namespace App\Http\Resources\Parent\Accounts\Fee\Feepaymentinformation;

use App\Http\Resources\Parent\Accounts\Fee\Feepaymentinformation\ParentfeepaymentinformationResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

class ParentfeepaymentinformationCollection extends ResourceCollection
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
            'feepaymentinformation' => ParentfeepaymentinformationResource::collection($this->collection),
            // 'pagination' => [
            //     'total' => $this->total(),
            //     'count' => $this->count(),
            //     'per_page' => $this->perPage(),
            //     'current_page' => $this->currentPage(),
            //     'total_pages' => $this->lastPage(),
            // ],
        ];
    }
}
