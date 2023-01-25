<?php

namespace App\Http\Resources\Admin\Feed\Feedtag\Feedtagpost;

use App\Http\Resources\Admin\Feed\Feedpoll\FeedpollResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class FeedtagpostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = auth()->user();
        $feedpostable = $this->feedpostable;
        $usertype = ($feedpostable->usertype == "STUDENT") ? $feedpostable->classmaster->name : Str::of($feedpostable->usertype)->lower()->ucfirst();

        $feedreportcount = $this->feedreportedpivot->count();

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
            'reported_status' => false,
            'hashtag' => collect($this->feedtag)?->map(function ($item) {
                return ['uuid' => $item->uuid, 'name' => $item->name];
            }),
            'reported_count' => $feedreportcount ? ('Reported by ' . $feedreportcount . ' user' . (($feedreportcount > 1) ? 's' : '')) : 0,
            'avatar' => $feedpostable->avatar ? $feedpostable->avatar : '',
            'created_by' => $feedpostable->name . ' (' . $usertype . ')',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
        ];
    }
}
