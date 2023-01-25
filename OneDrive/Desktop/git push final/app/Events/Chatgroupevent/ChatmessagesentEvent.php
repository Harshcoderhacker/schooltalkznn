<?php

namespace App\Events\Chatgroupevent;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ChatmessagesentEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user, $chatgroup, $chatmessage;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($user, $chatmessage, $chatgroup)
    {
        $this->user = $user;
        $this->chatmessage = $chatmessage;
        $this->chatgroup = $chatgroup;
    }

    // public function broadcastWith()
    // {

    //     return [

    //         'conversation_id' => $this->conversation_id,
    //         'receiver_id' => $this->receiver_id,
    //     ];

    // }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        Log::info('----------start---------------');
        Log::info(json_encode($this->user));
        Log::info('-------------------------');
        Log::info(json_encode($this->chatmessage));
        Log::info('-------------------------');
        Log::info(json_encode($this->chatgroup));
        Log::info('-----------end--------------' . $this->chatgroup->id . '-working---');
        return new PrivateChannel('chatgroup.' . $this->chatgroup->id);
    }
}
