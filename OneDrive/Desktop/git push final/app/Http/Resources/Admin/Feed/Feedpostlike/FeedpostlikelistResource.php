<?php

namespace App\Http\Resources\Admin\Feed\Feedpostlike;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedpostlikelistResource extends JsonResource
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
            'name' => $this->feedpostlikeable->name ? $this->feedpostlikeable->name . ' (' . $this->feedpostlikeable->usertype . ')' : '',
            'avatar' => $this->feedpostlikeable->avatar ? $this->feedpostlikeable->avatar : '',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
        ];
    }
}
