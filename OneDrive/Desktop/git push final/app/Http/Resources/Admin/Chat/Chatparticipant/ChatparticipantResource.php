<?php

namespace App\Http\Resources\Admin\Chat\Chatparticipant;

use Illuminate\Http\Resources\Json\JsonResource;

class ChatparticipantResource extends JsonResource
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
            'name' => $this->chatparticipantable->name ? $this->chatparticipantable->name : '',
            'avatar' => $this->chatparticipantable->avatar ? $this->chatparticipantable->avatar : '',
            'usertype' => $this->chatparticipantable->usertype ? $this->chatparticipantable->usertype : '',
        ];
    }
}
