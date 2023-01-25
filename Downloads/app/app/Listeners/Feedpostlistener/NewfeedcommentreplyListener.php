<?php

namespace App\Listeners\Feedpostlistener;

use App;
use App\Events\NewfeedpostEvent;
use App\Notifications\Feedpostnotification\NewfeedcommentreplyNotification;
use Illuminate\Support\Facades\Log;

class NewfeedcommentreplyListener
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

        $user = $event->feedcommentreply->feedcommentreplyable;
        $feedpost = $event->feedcommentreply->feedpost;
        $feedcomment = $event->feedcommentreply->feedcomment;

        switch ($user->usertype) {
            case 'ADMIN':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcommentreply->feedpost->feedpostable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                        $user->name . ' (School Admin)',
                        ' replied on your post comment'));

                    if ($user->uuid != $feedcomment->feedcommentable->uuid) {
                        $feedcomment->feedcommentable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                            $user->name . ' (School Admin)',
                            ' replied on your comment'));
                    }

                }

                break;

            case 'STAFF':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcommentreply->feedpost->feedpostable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                        $user->name . ' (Teacher)',
                        ' replied on your post comment'));

                    if ($user->uuid != $feedcomment->feedcommentable->uuid) {
                        $feedcomment->feedcommentable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                            $user->name . ' (Teacher)',
                            ' replied on your comment'));
                    }

                }

                break;

            case 'STUDENT':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $event->feedcommentreply->feedpost->feedpostable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                        $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                        ' replied on your post comment'));

                    if ($user->uuid != $feedcomment->feedcommentable->uuid) {
                        $feedcomment->feedcommentable->notify(new NewfeedcommentreplyNotification($event->feedcommentreply,
                            $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                            ' replied on your comment'));
                    }

                }

                break;
            default:
                Log::info('----------NewfeedpostcommentListener Type Not Found-----------');
                Log::info(json_encode($event));
        }

    }
}
