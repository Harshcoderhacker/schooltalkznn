<?php

namespace App\Http\Resources\Parent\Feed\Feedidealibrary;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentidealibraryResource extends JsonResource
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
            'category' => $this->idea_category ? config('archive.idea_category')[$this->idea_category] : '',
            'star_value' => $this->starvalue ? $this->starvalue : '',
            'tag' => $this->tag ? $this->tag : '',
            'image' => $this->image ? 'storage' . $this->image : '',
            'description' => $this->description ? $this->description : '',
        ];
    }
}
