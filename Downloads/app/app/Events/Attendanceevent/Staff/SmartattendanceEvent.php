<?php

namespace App\Events\Attendanceevent\Staff;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class SmartattendanceEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $smartattendance;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($smartattendance)
    {
        $this->smartattendance = $smartattendance;
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
