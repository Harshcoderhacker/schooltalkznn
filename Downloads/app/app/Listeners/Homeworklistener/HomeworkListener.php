<?php

namespace App\Listeners\Homeworklistener;

use App\Events\Homeworkevent\HomeworkEvent;
use App\Models\Admin\Student\Student;
use App\Notifications\Homeworknotification\HomeworkNotification;
use Illuminate\Support\Facades\Log;

class HomeworkListener
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
     * @param  \App\Events\HomeworkEvent  $event
     * @return void
     */
    public function handle($event)
    {
        $user = $event->homework->homeworkable;
        $homework = $event->homework;

        switch ($user->usertype) {

            case 'ADMIN':

                $student = Student::getourclass($homework->academicyear_id, $homework->classmaster_id, $homework->section_id)
                    ->get();

                Student::getourclass($homework->academicyear_id, $homework->classmaster_id, $homework->section_id)
                    ->get()
                    ->each
                    ->notify(new HomeworkNotification($event->homework,
                        $user->name . ' (School Admin)',
                        ' has created a new homework'));

                break;

            case 'STAFF':

                Student::getourclass($homework->academicyear_id, $homework->classmaster_id, $homework->section_id)
                    ->get()
                    ->each
                    ->notify(new HomeworkNotification($event->homework,
                        'Your ' . $user->assignsubject()->oldest()->first()?->subject?->name . ' Teacher ' . $user->name,
                        ' has created a new homework'));

                break;

            default:
                Log::info('----------HomeworkListener Type Not Found-----------');
                Log::info(json_encode($event));
        }
    }
}
