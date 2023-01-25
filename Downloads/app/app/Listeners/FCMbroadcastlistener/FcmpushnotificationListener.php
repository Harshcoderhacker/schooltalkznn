<?php

namespace App\Listeners\FCMbroadcastlistener;

use App;
use App\Events\NewfeedpostEvent;
use App\Models\Admin\Auth\User;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use App\Notifications\FCMbroadcastnotification\FcmpushnotificationNotification;

class FcmpushnotificationListener
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
     * @param  \App\Events\NewfeedpostEvent  $event
     * @return void
     */
    public function handle($event)
    {

        $data = $event->fcmpushnotification;

        if ($data->is_admin) {
            User::where('active', true)
                ->where('is_accountactive', true)
                ->get()
                ->each
                ->notify(new FcmpushnotificationNotification($data->title, $data->body, $data->uuid));
        }

        if ($data->is_staff) {
            Staff::where('active', true)
                ->where('is_accountactive', true)
                ->get()
                ->each
                ->notify(new FcmpushnotificationNotification($data->title, $data->body, $data->uuid));
        }

        if ($data->is_student) {
            Student::where('active', true)
                ->get()
                ->each
                ->notify(new FcmpushnotificationNotification($data->title, $data->body, $data->uuid));

        }

    }
}
