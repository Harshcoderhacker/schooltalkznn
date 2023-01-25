<?php

namespace App\Providers;

use App\Repository\Api\Admin\Businesslogic\Attendance\AdminattendanceApiRepository;
use App\Repository\Api\Admin\Businesslogic\Auth\AdminAuthApiRepository;
use App\Repository\Api\Admin\Businesslogic\Chat\AdminchatApiRepository;
use App\Repository\Api\Admin\Businesslogic\Classroutine\Staff\AdminstaffclassroutineApiRepository;
use App\Repository\Api\Admin\Businesslogic\Class\Classdetail\AdminclassdetailApiRepository;
use App\Repository\Api\Admin\Businesslogic\Dashboard\AdminDashboardApiRepository;
use App\Repository\Api\Admin\Businesslogic\Exam\Offlineexam\AdminexamApiRepository;
use App\Repository\Api\Admin\Businesslogic\Exam\Onlineassessment\AdminonlineassessmentapiApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedcommentreplyApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedpollApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedpostApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedpostcommentApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedpostlikeApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedreportedApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedstickerApiRepository;
use App\Repository\Api\Admin\Businesslogic\Feed\AdminfeedtagApiRepository;
use App\Repository\Api\Admin\Businesslogic\Homework\AdminhomeworkApiRepository;
use App\Repository\Api\Admin\Businesslogic\Material\AdminmaterialApiRepository;
use App\Repository\Api\Admin\Businesslogic\Notification\AdminnotificationApiRepository;
use App\Repository\Api\Admin\Businesslogic\Payroll\AdminpayrollApiRepository;
use App\Repository\Api\Admin\Businesslogic\Profile\AdminProfileApiRepository;
use App\Repository\Api\Admin\Businesslogic\Settings\Academicsetting\Classmaster\ClassmasterApiRepository;
use App\Repository\Api\Admin\Businesslogic\Settings\Academicsetting\Section\SectionApiRepository;
use App\Repository\Api\Admin\Businesslogic\Settings\Staffsettings\StaffdepartmentApiRepository;
use App\Repository\Api\Admin\Businesslogic\Settings\Staffsettings\StaffdesignationApiRepository;
use App\Repository\Api\Admin\Businesslogic\Staff\Staff\AdminstaffApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Attendance\IAdminattendanceApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Auth\IAdminAuthApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Chat\IAdminchatApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Classroutine\Staff\IAdminstaffclassroutineApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Class\Classdetail\IAdminclassdetailApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Dashboard\IAdminDashboardApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Exam\Offlineexam\IAdminexamApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Exam\Onlineassessment\IAdminonlineassessmentapiApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedcommentreplyApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpollApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostcommentApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostlikeApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedreportedApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedstickerApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedtagApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Homework\IAdminhomeworkApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Material\IAdminmaterialApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Notification\IAdminnotificationApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Payroll\IAdminpayrollApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Profile\IAdminProfileApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Classmaster\IClassmasterApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Section\ISectionApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Settings\Staffsettings\IStaffdepartmentApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Settings\Staffsettings\IStaffdesignationApiRepository;
use App\Repository\Api\Admin\Interfacelayer\Staff\Staff\IAdminstaffApiRepository;
use Illuminate\Support\ServiceProvider;

class AdminApiRepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // Auth
        $this->app->bind(IAdminAuthApiRepository::class, AdminAuthApiRepository::class);
        // Dashboard
        $this->app->bind(IAdminDashboardApiRepository::class, AdminDashboardApiRepository::class);
        // Profile
        $this->app->bind(IAdminProfileApiRepository::class, AdminProfileApiRepository::class);

        // Setting/Staffsettings
        $this->app->bind(IClassmasterApiRepository::class, ClassmasterApiRepository::class);
        // Setting/Staffsettings
        $this->app->bind(ISectionApiRepository::class, SectionApiRepository::class);

        // Class
        $this->app->bind(IAdminclassdetailApiRepository::class, AdminclassdetailApiRepository::class);
        // Setting/Staffsettings
        $this->app->bind(IStaffdepartmentApiRepository::class, StaffdepartmentApiRepository::class);
        $this->app->bind(IStaffdesignationApiRepository::class, StaffdesignationApiRepository::class);
        //Admin Staff
        $this->app->bind(IAdminstaffApiRepository::class, AdminstaffApiRepository::class);
        //Admin Feed
        $this->app->bind(IAdminfeedpostApiRepository::class, AdminfeedpostApiRepository::class);
        $this->app->bind(IAdminfeedpostcommentApiRepository::class, AdminfeedpostcommentApiRepository::class);
        $this->app->bind(IAdminfeedcommentreplyApiRepository::class, AdminfeedcommentreplyApiRepository::class);
        $this->app->bind(IAdminfeedpostlikeApiRepository::class, AdminfeedpostlikeApiRepository::class);
        $this->app->bind(IAdminfeedpollApiRepository::class, AdminfeedpollApiRepository::class);
        $this->app->bind(IAdminfeedtagApiRepository::class, AdminfeedtagApiRepository::class);
        $this->app->bind(IAdminfeedreportedApiRepository::class, AdminfeedreportedApiRepository::class);
        $this->app->bind(IAdminfeedstickerApiRepository::class, AdminfeedstickerApiRepository::class);
        //Admin Staff Payroll
        $this->app->bind(IAdminpayrollApiRepository::class, AdminpayrollApiRepository::class);
        //Admin Attendance
        $this->app->bind(IAdminattendanceApiRepository::class, AdminattendanceApiRepository::class);
        //Staff Classroutine
        $this->app->bind(IAdminstaffclassroutineApiRepository::class, AdminstaffclassroutineApiRepository::class);
        //Admin Homework
        $this->app->bind(IAdminhomeworkApiRepository::class, AdminhomeworkApiRepository::class);
        //Admin Offline Exam
        $this->app->bind(IAdminexamApiRepository::class, AdminexamApiRepository::class);
        //Admin Onlineassessment
        $this->app->bind(IAdminonlineassessmentapiApiRepository::class, AdminonlineassessmentapiApiRepository::class);
        //Admin Notification
        $this->app->bind(IAdminnotificationApiRepository::class, AdminnotificationApiRepository::class);
        //Admin Chat
        $this->app->bind(IAdminchatApiRepository::class, AdminchatApiRepository::class);
        //Material
        $this->app->bind(IAdminmaterialApiRepository::class, AdminmaterialApiRepository::class);
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
