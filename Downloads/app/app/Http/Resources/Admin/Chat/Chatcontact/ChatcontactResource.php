<?php

namespace App\Http\Resources\Admin\Chat\Chatcontact;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatcontactResource extends JsonResource
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

        if ($this->chatparticipant) {
            $chatparticipant = $this->chatparticipant->whereNotNull('chatparticipantable')->first()->chatparticipantable;

            switch ($chatparticipant->usertype) {
                case 'ADMIN':
                    $groupname = $chatparticipant->name . ' (Admin)';
                    break;
                case 'STAFF':
                    $groupname = $chatparticipant->name . ' (Staff)';
                    break;
                case 'STUDENT':
                    $groupname = $chatparticipant->name . ' (' . ($chatparticipant->classmaster ? $chatparticipant->classmaster->name : '') . ' ' . ($chatparticipant->section ? $chatparticipant->section->name : '') . ')';

                    break;
                default:
                    Log::info('----------chatparticipantable one to one Error-----------');
            }
        }

        return [
            'chatgroup_uuid' => $this->uuid ? $this->uuid : '',
            'groupavatar' => $this->groupavatar ? $this->groupavatar : '',
            'groupname' => $groupname,
            'lastupdated_at' => $this->lastupdated_at ? Carbon::parse($this->lastupdated_at)->diffForhumans() : '',
            'unread_count' => $this->chatmessageread_count ? $this->chatmessageread_count : '',
            'chatmessage' => $chatmessage,
        ];
    }
}
