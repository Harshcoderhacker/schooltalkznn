<?php

namespace App\Http\Resources\Staff\Feed\Feedcommentreply;

use Illuminate\Http\Resources\Json\JsonResource;

class StafffeedcommentreplyResource extends JsonResource
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
            'reply' => $this->reply ? $this->reply : '',
            'avatar' => $this->feedcommentreplyable->avatar ? $this->feedcommentreplyable->avatar : '',
            'is_feedpostcommentreplyedit' => ($this->feedcommentreplyable->uuid == auth()->user()->uuid) ? true : false,
            'created_by' => $this->feedcommentreplyable->name,
            'created_at' => $this->created_at->diffForhumans(),
        ];
    }
}
