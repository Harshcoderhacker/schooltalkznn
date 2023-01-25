<?php

namespace App\Http\Resources\Admin\Feed\Feedpost;

use App\Http\Resources\Admin\Feed\Feedpoll\FeedpollResource;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class FeedpostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = (auth()->user()->usertype == "PARENT") ? Parenthelper::getstudent() : auth()->user();

        $feedpostable = $this->feedpostable;
        $usertype = ($feedpostable->usertype == "STUDENT") ? $feedpostable->classmaster->name : Str::of($feedpostable->usertype)->lower()->ucfirst();

        return [
            'uuid' => $this->uuid ? $this->uuid : '',
            'post' => $this->post ? $this->post : '',
            'type' => $this->type ? $this->type : '',
            'is_mediatype' => $this->is_mediatype ? $this->is_mediatype : '',
            'image' => $this->image ? json_decode($this->image) : '',
            'video' => $this->video ? $this->video : '',
            'vote_count' => $this->feedpollcount->count(),
            'is_voted' => ($user->feedpollcount->where('feedpost_id', $this->id)->count() > 0) ? true : false,
            'poll' => (sizeof($this->feedpoll) == 0) ? [] : FeedpollResource::collection($this->feedpoll),
            'is_postliked' => ($user->feedpostlike->where('feedpost_id', $this->id)->count() == 0) ? false : true,
            'feedpostlike_count' => $this->feedpostlike_count ? $this->feedpostlike_count : 0,
            'feedcomment_count' => $this->feedcomment_count ? $this->feedcomment_count : 0,
            'is_feedpostedit' => true,
            'reported_status' => ($this->reported_stage != 3) ? true : false,
            'hashtag' => collect($this->feedtag)?->map(function ($item) {
                return ['uuid' => $item->uuid, 'name' => $item->name];
            }),
            'avatar' => $feedpostable->avatar ? $feedpostable->avatar : '',
            'created_by' => $feedpostable->name . ' (' . $usertype . ')',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
        ];
    }
}
