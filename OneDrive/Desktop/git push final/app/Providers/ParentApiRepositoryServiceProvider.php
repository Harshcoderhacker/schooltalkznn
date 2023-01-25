<?php

namespace App\Providers;

use App\Repository\Api\Parent\Businesslogic\Attendance\ParentattendanceApiRepository;
use App\Repository\Api\Parent\Businesslogic\Auth\ParentAuthApiRepository;
use App\Repository\Api\Parent\Businesslogic\Chat\ParentchatApiRepository;
use App\Repository\Api\Parent\Businesslogic\Dashboard\ParentDashboardApiRepository;
use App\Repository\Api\Parent\Businesslogic\Emotioncapture\ParentemotioncaptureApiRepository;
use App\Repository\Api\Parent\Businesslogic\Exam\Offlineexam\ParentofflineexamApiRepository;
use App\Repository\Api\Parent\Businesslogic\Exam\Onlineexam\ParentonlineexamApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedcommentreplyApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedidealibraryApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedpollApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedpostApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedpostcommentApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedpostlikeApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedreportedApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedstickerApiRepository;
use App\Repository\Api\Parent\Businesslogic\Feed\ParentfeedtagApiRepository;
use App\Repository\Api\Parent\Businesslogic\Fee\ParentfeeApiRepository;
use App\Repository\Api\Parent\Businesslogic\Gamification\ParentgamificationApiRepository;
use App\Repository\Api\Parent\Businesslogic\Homework\ParenthomeworkApiRepository;
use App\Repository\Api\Parent\Businesslogic\Material\ParentmaterialApiRepository;
use App\Repository\Api\Parent\Businesslogic\Notification\ParentnotificationApiRepository;
use App\Repository\Api\Parent\Businesslogic\Profile\ParentProfileApiRepository;
use App\Repository\Api\Parent\Businesslogic\Staffandsubject\ParentstaffandsubjectApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Attendance\IParentattendanceApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Auth\IParentAuthApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Chat\IParentchatApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Dashboard\IParentDashboardApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Emotioncapture\IParentemotioncaptureApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Exam\Offlineexam\IParentofflineexamApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Exam\Onlineexam\IParentonlineexamApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedcommentreplyApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedidealibraryApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpollApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostcommentApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostlikeApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedreportedApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedstickerApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedtagApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Fee\IParentfeeApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Gamification\IParentgamificationApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Homework\IParenthomeworkApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Material\IParentmaterialApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Notification\IParentnotificationApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Profile\IParentProfileApiRepository;
use App\Repository\Api\Parent\Interfacelayer\Staffandsubject\IParentstaffandsubjectApiRepository;
use Illuminate\Support\ServiceProvider;

class ParentApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Auth
        $this->app->bind(IParentAuthApiRepository::class, ParentAuthApiRepository::class);
        //Dashboard
        $this->app->bind(IParentDashboardApiRepository::class, ParentDashboardApiRepository::class);
        //Profile
        $this->app->bind(IParentProfileApiRepository::class, ParentProfileApiRepository::class);
        //Feed
        $this->app->bind(IParentfeedpostApiRepository::class, ParentfeedpostApiRepository::class);
        $this->app->bind(IParentfeedpostcommentApiRepository::class, ParentfeedpostcommentApiRepository::class);
        $this->app->bind(IParentfeedcommentreplyApiRepository::class, ParentfeedcommentreplyApiRepository::class);
        $this->app->bind(IParentfeedpostlikeApiRepository::class, ParentfeedpostlikeApiRepository::class);
        $this->app->bind(IParentfeedpollApiRepository::class, ParentfeedpollApiRepository::class);
        $this->app->bind(IParentfeedreportedApiRepository::class, ParentfeedreportedApiRepository::class);
        $this->app->bind(IParentfeedtagApiRepository::class, ParentfeedtagApiRepository::class);
        $this->app->bind(IParentfeedstickerApiRepository::class, ParentfeedstickerApiRepository::class);
        $this->app->bind(IParentfeedidealibraryApiRepository::class, ParentfeedidealibraryApiRepository::class);
        //Attendance
        $this->app->bind(IParentattendanceApiRepository::class, ParentattendanceApiRepository::class);
        //Notification
        $this->app->bind(IParentnotificationApiRepository::class, ParentnotificationApiRepository::class);
        //Parent Homework
        $this->app->bind(IParenthomeworkApiRepository::class, ParenthomeworkApiRepository::class);
        //Parent Chat
        $this->app->bind(IParentchatApiRepository::class, ParentchatApiRepository::class);
        //Parent Fee
        $this->app->bind(IParentfeeApiRepository::class, ParentfeeApiRepository::class);
        //Material
        $this->app->bind(IParentmaterialApiRepository::class, ParentmaterialApiRepository::class);
        //Gamification
        $this->app->bind(IParentgamificationApiRepository::class, ParentgamificationApiRepository::class);
        //Staff and Subjects
        $this->app->bind(IParentstaffandsubjectApiRepository::class, ParentstaffandsubjectApiRepository::class);
        //Exam
        $this->app->bind(IParentofflineexamApiRepository::class, ParentofflineexamApiRepository::class);
        //Onlineassessment
        $this->app->bind(IParentonlineexamApiRepository::class, ParentonlineexamApiRepository::class);
        //Emotioncapture
        $this->app->bind(IParentemotioncaptureApiRepository::class, ParentemotioncaptureApiRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
