<?php

namespace App\Http\Resources\Common\Material\Materiallist;

use Illuminate\Http\Resources\Json\JsonResource;

class MateriallistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'title' => $this->title ? $this->title : '',
            'document' => $this->document ? $this->document : '',
            'document_type' => $this->document_type ? $this->document_type : '',
            'uploaded_by' => $this->materiallistable ? $this->materiallistable->name . ' (' . $this->materiallistable->usertype . ')' : '',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
            'materiallist_uuid' => $this->uuid ? $this->uuid : '',
        ];
    }
}
