<?php

namespace App\Events\Feedpostevent;

use App\Models\Admin\Feeds\Feedpostlike;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewfeedpostlikeEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $feedpostlike;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Feedpostlike $feedpostlike)
    {
        $this->feedpostlike = $feedpostlike;
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
