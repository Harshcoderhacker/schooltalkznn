<?php

namespace App\Http\Resources\Parent\Chat\Chatgroupfilter;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentchatgroupfilterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        $chatmessage = ($this->chatmessageable->uuid == auth()->user()->uuid) ? $this->body : $this->chatmessageable->name . ': ' . $this->body;

        return [
            'chatgroup_uuid' => $this->chatgroup->uuid ? $this->chatgroup->uuid : '',
            'groupavatar' => $this->chatgroup->groupavatar ? $this->chatgroup->groupavatar : '',
            'groupname' => $this->chatgroup->groupname ? $this->chatgroup->groupname : '',
            'lastupdated_at' => $this->chatgroup->lastupdated_at ? Carbon::parse($this->chatgroup->lastupdated_at)->diffForhumans() : '',
            'unread_count' => $this->chatgroup->chatmessageread_count ? $this->chatgroup->chatmessageread_count : '',
            'chatmessage' => $chatmessage,
        ];
    }
}
