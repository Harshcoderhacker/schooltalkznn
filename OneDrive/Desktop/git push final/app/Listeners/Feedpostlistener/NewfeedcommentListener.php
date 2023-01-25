<?php

namespace App\Listeners\Feedpostlistener;

use App;
use App\Events\NewfeedpostEvent;
use App\Notifications\Feedpostnotification\NewfeedcommentNotification;
use Illuminate\Support\Facades\Log;

class NewfeedcommentListener
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

        $user = $event->feedcomment->feedcommentable;
        $feedpost = $event->feedcomment->feedpost;

        switch ($user->usertype) {
            case 'ADMIN':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcomment->feedpost->feedpostable->notify(new NewfeedcommentNotification($event->feedcomment,
                        $user->name . ' (School Admin)',
                        ' commented on your post'));
                }

                break;

            case 'STAFF':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcomment->feedpost->feedpostable->notify(new NewfeedcommentNotification($event->feedcomment,
                        $user->name . ' (Teacher)',
                        ' commented on your post'));
                }

                break;

            case 'STUDENT':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcomment->feedpost->feedpostable->notify(new NewfeedcommentNotification($event->feedcomment,
                        $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                        ' commented on your post'));
                }

                break;
            default:
                Log::info('----------NewfeedpostcommentListener Type Not Found-----------');
                Log::info(json_encode($event));
        }

    }
}
