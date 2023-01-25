<?php

namespace App\Events\Homeworkevent;

use App\Models\Admin\Homework\Homeworklist;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HomeworklistEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $homeworklist, $user, $type;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Homeworklist $homeworklist, $user, $type)
    {
        $this->homeworklist = $homeworklist;
        $this->user = $user;
        $this->type = $type;

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
