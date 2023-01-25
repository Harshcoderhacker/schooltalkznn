<?php

namespace App\Http\Resources\Parent\Feed\Feedpost;

use App\Http\Resources\Parent\Feed\Feedpoll\ParentfeedpollResource;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ParentfeedpostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $user = Parenthelper::getstudent();
        $feedpostable = $this->feedpostable;
        $usertype = ($feedpostable->usertype == "PARENT") ? $feedpostable->classmaster->name : Str::of($feedpostable->usertype)->lower()->ucfirst();

        return [
            'uuid' => $this->uuid ? $this->uuid : '',
            'post' => $this->post ? $this->post : '',
            'type' => $this->type ? $this->type : '',
            'is_mediatype' => $this->is_mediatype ? $this->is_mediatype : '',
            'image' => $this->image ? json_decode($this->image) : '',
            'video' => $this->video ? $this->video : '',
            'vote_count' => $this->feedpollcount->count(),
            'is_voted' => ($user->feedpollcount->where('feedpost_id', $this->id)->count() > 0) ? true : false,
            'poll' => (sizeof($this->feedpoll) == 0) ? [] : ParentfeedpollResource::collection($this->feedpoll),
            'is_postliked' => ($user->feedpostlike->where('feedpost_id', $this->id)->count() == 0) ? false : true,
            'feedpostlike_count' => $this->feedpostlike_count ? $this->feedpostlike_count : 0,
            'feedcomment_count' => $this->feedcomment_count ? $this->feedcomment_count : 0,
            'is_feedpostedit' => ($feedpostable->uuid == $user->uuid) ? true : false,
            'reported_status' => ($this->reported_stage != 3) ? true : false,
            'hashtag' => collect($this->feedtag)?->map(function ($item) {
                return ['uuid' => $item->uuid, 'name' => $item->name];
            }),
            'avatar' => $feedpostable->avatar ? $feedpostable->avatar : '',
            'created_by' => $feedpostable->name . ' (' . $usertype . ')',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
            'comment_type' => env('FEEDCOMMENT') ? env('FEEDCOMMENT') : 1,
        ];
    }
}
