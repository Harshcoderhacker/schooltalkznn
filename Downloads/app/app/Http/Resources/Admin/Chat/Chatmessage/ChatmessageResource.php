<?php

namespace App\Http\Resources\Admin\Chat\Chatmessage;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatmessageResource extends JsonResource
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
            'body' => $this->body ? $this->body : '',
            'messagetype' => $this->messagetype ? $this->messagetype : '',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans() : '',
            'name' => $this->chatmessageable ? $this->chatmessageable->name . ' (' . $this->chatmessageable->usertype . ')' : '',
            'avatar' => ($this->chatmessageable && $this->chatmessageable->avatar) ? $this->chatmessageable->avatar : '',
            'alligntype' => ($this->chatmessageable?->uuid == auth()->user()->uuid) ? 'right' : 'left',
        ];
    }
}
