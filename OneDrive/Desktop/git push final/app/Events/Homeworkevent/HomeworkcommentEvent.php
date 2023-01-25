<?php

namespace App\Events\Homeworkevent;

use App\Models\Admin\Homework\Homeworkcomment;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class HomeworkcommentEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $homeworkcomment;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Homeworkcomment $homeworkcomment)
    {
        $this->homeworkcomment = $homeworkcomment;
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
