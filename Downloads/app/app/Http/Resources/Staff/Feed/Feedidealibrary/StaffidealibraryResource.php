<?php

namespace App\Http\Resources\Staff\Feed\Feedidealibrary;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffidealibraryResource extends JsonResource
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
            'uuid' => $this->uuid ? $this->uuid : '',
            'title' => $this->name ? $this->name : '',
            'star_value' => $this->starvalue ? $this->starvalue : '',
            'tag' => $this->tag ? $this->tag : '',
            'image' => $this->image ? 'storage' . $this->image : '',
            'description' => $this->description ? $this->description : '',
        ];
    }
}
