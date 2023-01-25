<?php

namespace App\Events\Feedpostevent;

use App\Models\Admin\Feeds\Feedcommentreply;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewfeedcommentreplyEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedcommentreply;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Feedcommentreply $feedcommentreply)
    {
        $this->feedcommentreply = $feedcommentreply;
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
