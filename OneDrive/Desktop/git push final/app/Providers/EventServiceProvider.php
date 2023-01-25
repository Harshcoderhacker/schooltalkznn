<?php

namespace App\Providers;

use App\Events\Accountsevent\Fee\FeereminderEvent;
use App\Events\Attendanceevent\Staff\SmartattendanceEvent;
use App\Events\FCMbroadcastevent\FcmpushnotificationEvent;
use App\Events\Feedpostevent\FeedposttrimvideoEvent;
use App\Events\Feedpostevent\NewfeedcommentEvent;
use App\Events\Feedpostevent\NewfeedcommentreplyEvent;
use App\Events\Feedpostevent\NewfeedpostEvent;
use App\Events\Feedpostevent\NewfeedpostlikeEvent;
use App\Events\Homeworkevent\HomeworkcommentEvent;
use App\Events\Homeworkevent\HomeworkEvent;
use App\Events\Homeworkevent\HomeworklistEvent;
use App\Listeners\Accountslistener\Fee\FeereminderListener;
use App\Listeners\Attendancelistener\Staff\SmartattendanceListener;
use App\Listeners\FCMbroadcastlistener\FcmpushnotificationListener;
use App\Listeners\Feedpostlistener\FeedposttrimvideoListener;
use App\Listeners\Feedpostlistener\NewfeedcommentListener;
use App\Listeners\Feedpostlistener\NewfeedcommentreplyListener;
use App\Listeners\Feedpostlistener\NewfeedpostlikeListener;
use App\Listeners\Feedpostlistener\NewfeedpostListener;
use App\Listeners\Homeworklistener\HomeworkcommentListener;
use App\Listeners\Homeworklistener\HomeworkListener;
use App\Listeners\Homeworklistener\HomeworklistListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {

        // Feed Post
        Event::listen(
            NewfeedpostEvent::class,
            [NewfeedpostListener::class, 'handle']
        );

        Event::listen(
            NewfeedcommentEvent::class,
            [NewfeedcommentListener::class, 'handle']
        );

        Event::listen(
            NewfeedcommentreplyEvent::class,
            [NewfeedcommentreplyListener::class, 'handle']
        );

        Event::listen(
            NewfeedpostlikeEvent::class,
            [NewfeedpostlikeListener::class, 'handle']
        );

        Event::listen(
            FeedposttrimvideoEvent::class,
            [FeedposttrimvideoListener::class, 'handle']
        );

        // Homework
        Event::listen(
            HomeworkEvent::class,
            [HomeworkListener::class, 'handle']
        );

        Event::listen(
            HomeworklistEvent::class,
            [HomeworklistListener::class, 'handle']
        );

        Event::listen(
            HomeworkcommentEvent::class,
            [HomeworkcommentListener::class, 'handle']
        );

        // Fees
        Event::listen(
            FeereminderEvent::class,
            [FeereminderListener::class, 'handle']
        );

        // Attendance
        Event::listen(
            SmartattendanceEvent::class,
            [SmartattendanceListener::class, 'handle']
        );

        // FCM Push Notification
        Event::listen(
            FcmpushnotificationEvent::class,
            [FcmpushnotificationListener::class, 'handle']
        );

    }
}
