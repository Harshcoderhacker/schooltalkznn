<?php

namespace App\Listeners\Feedpostlistener;

use App;
use App\Events\NewfeedpostEvent;
use App\Models\Admin\Feeds\Feedpost;
use App\Notifications\Feedpostnotification\NewfeedpostlikeNotification;
use Illuminate\Support\Facades\Log;

class NewfeedpostlikeListener
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

        $user = $event->feedpostlike->feedpostlikeable;
        $feedpost = $event->feedpostlike->feedpost;

        $likecount = Feedpost::find($feedpost->id)->feedpostlike->count();
        $msg = ($likecount == 1) ? ' gave first like for your post' : ' and ' . ($likecount - 1) . ' others have liked your post';

        switch ($user->usertype) {

            case 'ADMIN':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $feedpost->feedpostable->notify(new NewfeedpostlikeNotification($event->feedpostlike,
                        $user->name . ' (School Admin)',
                        $msg));
                }

                break;

            case 'STAFF':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $feedpost->feedpostable->notify(new NewfeedpostlikeNotification($event->feedpostlike,
                        $user->name . ' (Teacher)',
                        $msg));
                }

                break;

            case 'STUDENT':

                if ($user->uuid != $feedpost->feedpostable->uuid) {
                    $feedpost->feedpostable->notify(new NewfeedpostlikeNotification($event->feedpostlike,
                        $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                        $msg));
                }

                break;
            default:
                Log::info('----------NewfeedpostcommentListener Type Not Found-----------');
                Log::info(json_encode($event));
        }

    }
}
