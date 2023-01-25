<?php

namespace App\Events\FCMbroadcastevent;

use App\Models\Admin\Settings\Broadcast\Fcmpushnotification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FcmpushnotificationEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $fcmpushnotification;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Fcmpushnotification $fcmpushnotification)
    {
        $this->fcmpushnotification = $fcmpushnotification;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
