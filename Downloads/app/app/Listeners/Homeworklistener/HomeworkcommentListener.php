<?php

namespace App\Listeners\Homeworklistener;

use App\Events\Homeworkevent\HomeworkcommentEvent;

class HomeworkcommentListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\HomeworkcommentEvent  $event
     * @return void
     */
    public function handle(HomeworkcommentEvent $event)
    {

    }
}
