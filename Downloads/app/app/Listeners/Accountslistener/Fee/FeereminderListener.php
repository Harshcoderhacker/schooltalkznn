<?php

namespace App\Listeners\Accountslistener\Fee;

use App\Notifications\Accountsnotification\Fee\FeereminderNotification;

class FeereminderListener
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
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $event->student->aparent
            ->notify(new FeereminderNotification($event->student,
                $event->student->name . ' (Student : ' . $event->student->classmaster->name . ' - ' . $event->student->section->name . ')',
                ' Clear the outstanding fee'));
    }
}
