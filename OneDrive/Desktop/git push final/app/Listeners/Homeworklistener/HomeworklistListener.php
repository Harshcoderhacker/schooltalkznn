<?php

namespace App\Listeners\Homeworklistener;

use App;
use App\Events\Homeworkevent\HomeworklistEvent;
use App\Notifications\Homeworknotification\HomeworklistNotification;
use Illuminate\Support\Facades\Log;

class HomeworklistListener
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
     * @param  \App\Events\HomeworklistEvent  $event
     * @return void
     */
    public function handle(HomeworklistEvent $event)
    {
        Log::info('-----SUBMISSION----test-----------');
        switch ($event->type) {

            case 'SUBMISSION':
                Log::info('-----SUBMISSION----working-----------');
                $staff = $event->homeworklist->homework->staff;
                if ($staff) {
                    $staff->notify(new HomeworklistNotification(
                        $event->homeworklist,
                        $event->user->name . ' (Student : ' . $event->user->classmaster->name . ' - ' . $event->user->section->name . ')',
                        ' from your class homwork has submited'));
                } else {
                    Log::info('-----SUBMISSION-----Staff record  Not Found-----------');
                }

                break;

            case 'REJECTED':

                $student = $event->homeworklist->student;
                if ($student) {
                    $student->notify(new HomeworklistNotification(
                        $event->homeworklist,
                        ($event->user->usertype == 'ADMIN') ? 'Admin' : $event->user->assignsubject()->oldest()->first()?->subject?->name . ' Teacher ' . $event->user->name,
                        '  your homwork has rejected'));

                } else {
                    Log::info('-----REJECTED-----Student record  Not Found-----------');
                }

                break;

            default:
                Log::info('----------HomeworklistListener Type Not Found-----------');
                Log::info(json_encode($event));
        }

    }

}
