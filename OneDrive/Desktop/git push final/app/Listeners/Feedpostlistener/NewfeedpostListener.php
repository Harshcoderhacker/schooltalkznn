<?php

namespace App\Listeners\Feedpostlistener;

use App;
use App\Events\NewfeedpostEvent;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use App\Notifications\Feedpostnotification\NewfeedpostNotification;
use Illuminate\Support\Facades\Log;

class NewfeedpostListener
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

        $user = $event->feedpost->feedpostable;
        $type = ['post', 'archivement', 'poll'][$event->feedpost->type - 1];

        switch ($user->usertype) {
            case 'ADMIN':

                Student::where('active', true)
                    ->get()
                    ->each
                    ->notify(new NewfeedpostNotification($event->feedpost,
                        $user->name . ' (School Admin)',
                        ' has created a new ' . $type));

                Staff::where('active', true)
                    ->where('is_accountactive', true)
                    ->get()
                    ->each
                    ->notify(new NewfeedpostNotification($event->feedpost,
                        $user->name . ' (School Admin)',
                        ' has created a new ' . $type));

                break;

            case 'STAFF':

                // For Student
                $user->assignsubject->unique(function ($item) {
                    return $item['classmaster_id'] . $item['section_id'];
                })
                    ->each(fn($eachmap) =>
                        Student::getourclass(App::make('generalsetting')->academicyear_id, $eachmap->classmaster_id, $eachmap->section_id)
                            ->get()
                            ->each
                            ->notify(new NewfeedpostNotification($event->feedpost,
                                'Your ' . $user->assignsubject()->oldest()->first()?->subject?->name . ' Teacher ' . $user->name,
                                ' has created a new ' . $type)));

                // For Staff
                Staff::where('id', '<>', $user->id)
                    ->whereHas('assignsubject', fn($q) =>
                        $q->whereIn('classmaster_id', $user->assignsubject->pluck('classmaster_id'))
                            ->whereIn('section_id', $user->assignsubject->pluck('section_id')))
                    ->get()
                    ->each
                    ->notify(new NewfeedpostNotification($event->feedpost,
                        $user->assignsubject()->oldest()->first()?->subject?->name . ' Teacher ' . $user->name,
                        ' has created a new ' . $type));

                break;

            case 'STUDENT':

                Staff::where('active', true)
                    ->where('is_accountactive', true)
                    ->whereHas('assignsubject', fn($q) =>
                        $q->where('classmaster_id', $user->classmaster_id)->where('section_id', $user->section_id))
                    ->get()
                    ->each
                    ->notify(new NewfeedpostNotification($event->feedpost,
                        $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                        ' from your class has created a new ' . $type));

                Student::getourclass($user->academicyear_id, $user->classmaster_id, $user->section_id)
                    ->where('id', '<>', $user->id)
                    ->get()
                    ->each
                    ->notify(new NewfeedpostNotification($event->feedpost,
                        $user->name . ' (Student : ' . $user->classmaster->name . ' - ' . $user->section->name . ')',
                        ' from your class has created a new ' . $type));

                break;
            default:
                Log::info('----------NewfeedpostEvent Type Not Found-----------');
                Log::info(json_encode($event));
        }

    }
}
