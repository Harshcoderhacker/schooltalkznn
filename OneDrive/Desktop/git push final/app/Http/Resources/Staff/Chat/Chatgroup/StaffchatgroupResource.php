<?php

namespace App\Http\Resources\Staff\Chat\Chatgroup;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffchatgroupResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $chatmessage = '';
        if ($this->chatmessage->isNotEmpty() && $this->chatmessage->first()->chatmessageable->uuid == auth()->user()->uuid) {
            $chatmessage = $this->chatmessage->first()->body;
        } else if ($this->chatmessage->isNotEmpty()) {
            $chatmessage = $this->chatmessage->first()->chatmessageable->name . ': ' . $this->chatmessage->first()->body;
        }

        return [
            'chatgroup_uuid' => $this->uuid ? $this->uuid : '',
            'groupavatar' => $this->groupavatar ? $this->groupavatar : '',
            'groupname' => $this->groupname ? $this->groupname : '',
            'lastupdated_at' => $this->lastupdated_at ? Carbon::parse($this->lastupdated_at)->diffForhumans() : '',
            'unread_count' => $this->chatmessageread_count ? $this->chatmessageread_count : '',
            'chatmessage' => $chatmessage,
        ];
    }
}
