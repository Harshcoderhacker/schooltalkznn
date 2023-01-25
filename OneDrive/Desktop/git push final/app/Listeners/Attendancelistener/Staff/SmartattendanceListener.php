<?php

namespace App\Listeners\Attendancelistener\Staff;

use App\Notifications\Attendancenotification\Staff\SmartattendanceNotification;

class SmartattendanceListener
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
        $event->smartattendance
            ->assignedstaff
            ->notify(new SmartattendanceNotification($event->smartattendance,
                'Substitute Class',
                ' has been assigned'));
    }
}
