<?php

namespace App\Providers;

use App\Repository\Api\Staff\Businesslogic\Attendance\StaffattendanceApiRepository;
use App\Repository\Api\Staff\Businesslogic\Auth\StaffAuthApiRepository;
use App\Repository\Api\Staff\Businesslogic\Chat\StaffchatApiRepository;
use App\Repository\Api\Staff\Businesslogic\Classattendance\StaffclassattendanceApiRepository;
use App\Repository\Api\Staff\Businesslogic\Classinfo\StaffclassdetailApiRepository;
use App\Repository\Api\Staff\Businesslogic\Classroutine\StaffclassroutineApiRepository;
use App\Repository\Api\Staff\Businesslogic\Dashboard\StaffDashboardApiRepository;
use App\Repository\Api\Staff\Businesslogic\Exam\Offlineexam\StaffexamApiRepository;
use App\Repository\Api\Staff\Businesslogic\Exam\Onlineassessment\StaffonlineassessmentapiApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedcommentreplyApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedidealibraryApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedpollApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedpostApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedpostcommentApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedpostlikeApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedreportedApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedstickerApiRepository;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedtagApiRepository;
use App\Repository\Api\Staff\Businesslogic\Gamification\StaffgamificationApiRepository;
use App\Repository\Api\Staff\Businesslogic\Homework\StaffhomeworkApiRepository;
use App\Repository\Api\Staff\Businesslogic\Material\StaffmaterialApiRepository;
use App\Repository\Api\Staff\Businesslogic\Notification\StaffnotificationApiRepository;
use App\Repository\Api\Staff\Businesslogic\Payroll\StaffpayrollApiRepository;
use App\Repository\Api\Staff\Businesslogic\Profile\StaffProfileApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Attendance\IStaffattendanceApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Auth\IStaffAuthApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Chat\IStaffchatApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Classattendance\IStaffclassattendanceApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Classinfo\IStaffclassdetailApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Classroutine\IStaffclassroutineApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Dashboard\IStaffDashboardApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Exam\Offlineexam\IStaffexamApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Exam\Onlineassessment\IStaffonlineassessmentapiApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedcommentreplyApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedidealibraryApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpollApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostcommentApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostlikeApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedreportedApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedstickerApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedtagApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Gamification\IStaffgamificationApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Homework\IStaffhomeworkApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Material\IStaffmaterialApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Notification\IStaffnotificationApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Payroll\IStaffpayrollApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Profile\IStaffProfileApiRepository;
use Illuminate\Support\ServiceProvider;

class SaffApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //Auth
        $this->app->bind(IStaffAuthApiRepository::class, StaffAuthApiRepository::class);
        //Dashboard
        $this->app->bind(IStaffDashboardApiRepository::class, StaffDashboardApiRepository::class);
        //  Profile
        $this->app->bind(IStaffProfileApiRepository::class, StaffProfileApiRepository::class);
        //Staff Feed
        $this->app->bind(IStafffeedpostApiRepository::class, StafffeedpostApiRepository::class);
        $this->app->bind(IStafffeedpostcommentApiRepository::class, StafffeedpostcommentApiRepository::class);
        $this->app->bind(IStafffeedcommentreplyApiRepository::class, StafffeedcommentreplyApiRepository::class);
        $this->app->bind(IStafffeedpostlikeApiRepository::class, StafffeedpostlikeApiRepository::class);
        $this->app->bind(IStafffeedpollApiRepository::class, StafffeedpollApiRepository::class);
        $this->app->bind(IStafffeedreportedApiRepository::class, StafffeedreportedApiRepository::class);
        $this->app->bind(IStafffeedreportedApiRepository::class, StafffeedreportedApiRepository::class);
        $this->app->bind(IStafffeedtagApiRepository::class, StafffeedtagApiRepository::class);
        $this->app->bind(IStafffeedstickerApiRepository::class, StafffeedstickerApiRepository::class);
        $this->app->bind(IStafffeedidealibraryApiRepository::class, StafffeedidealibraryApiRepository::class);
        //Staff Payroll

        $this->app->bind(IStaffpayrollApiRepository::class, StaffpayrollApiRepository::class);
        //Staff Attendance
        $this->app->bind(IStaffattendanceApiRepository::class, StaffattendanceApiRepository::class);
        //Classroutine
        $this->app->bind(IStaffclassroutineApiRepository::class, StaffclassroutineApiRepository::class);
        //Notification
        $this->app->bind(IStaffnotificationApiRepository::class, StaffnotificationApiRepository::class);
        //Staff Homework
        $this->app->bind(IStaffhomeworkApiRepository::class, StaffhomeworkApiRepository::class);
        //Staff Offline Exam
        $this->app->bind(IStaffexamApiRepository::class, StaffexamApiRepository::class);
        //Staff Onlineassessment
        $this->app->bind(IStaffonlineassessmentapiApiRepository::class, StaffonlineassessmentapiApiRepository::class);
        //Staff Chat
        $this->app->bind(IStaffchatApiRepository::class, StaffchatApiRepository::class);
        //Staff Class Attendance
        $this->app->bind(IStaffclassattendanceApiRepository::class, StaffclassattendanceApiRepository::class);
        //ClassList
        $this->app->bind(IStaffclassdetailApiRepository::class, StaffclassdetailApiRepository::class);
        //Material
        $this->app->bind(IStaffmaterialApiRepository::class, StaffmaterialApiRepository::class);
        //Gamification
        $this->app->bind(IStaffgamificationApiRepository::class, StaffgamificationApiRepository::class);
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
