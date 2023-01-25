<?php

namespace App\Events\Feedpostevent;

use App\Models\Admin\Feeds\Feedcomment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewfeedcommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedcomment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Feedcomment $feedcomment)
    {
        $this->feedcomment = $feedcomment;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        // return new PrivateChannel('channel-name');
    }
}
