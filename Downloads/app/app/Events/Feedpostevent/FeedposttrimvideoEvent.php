<?php

namespace App\Events\Feedpostevent;

use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class FeedposttrimvideoEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedpost;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($feedpost)
    {
        $this->feedpost = $feedpost;
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
