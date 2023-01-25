<?php

namespace App\Http\Resources\Admin\Feed\Feedcomment;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedcommentResource extends JsonResource
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
            'comment' => $this->comment ? $this->comment : '',
            'avatar' => $this->feedcommentable->avatar ? $this->feedcommentable->avatar : '',
            'is_feedpostcommentedit' => ((auth()->user()->usertype == 'ADMIN') ? true : (($this->feedcommentable->uuid == auth()->user()->uuid) ? true : false)),
            'created_by' => $this->feedcommentable->name,
            'created_at' => $this->created_at->diffForhumans(),
            'commentreply_count' => $this->feedcommentreply_count ? $this->feedcommentreply_count : 0,
            'commenttype' => $this->commenttype,
            'usertype'=>$this->usertype,
        ];
    }
}
