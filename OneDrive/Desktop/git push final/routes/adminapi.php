<?php

use App\Http\Controllers\Api\Admin\Attendance\AdminattendanceApiController;
use App\Http\Controllers\Api\Admin\Auth\AdminauthApiController;
use App\Http\Controllers\Api\Admin\Chat\AdminchatApiController;
use App\Http\Controllers\Api\Admin\Classroutine\Staff\AdminstaffclassroutineApiController;
use App\Http\Controllers\Api\Admin\Class\Classdetail\AdminclassdetailApiController;
use App\Http\Controllers\Api\Admin\Dashboard\AdmindashboardApiController;
use App\Http\Controllers\Api\Admin\Exam\Offlineexam\AdminexamApiController;
use App\Http\Controllers\Api\Admin\Exam\Onlineassessment\AdminonlineassessmentApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedcommentApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedcommentreplyApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedpollApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedpostApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedpostlikeApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedreportedApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedstickerApiController;
use App\Http\Controllers\Api\Admin\Feed\AdminfeedtagApiController;
use App\Http\Controllers\Api\Admin\Homework\AdminhomeworkApiController;
use App\Http\Controllers\Api\Admin\Material\AdminmaterialApiController;
use App\Http\Controllers\Api\Admin\Notification\AdminnotificationApiController;
use App\Http\Controllers\Api\Admin\Payroll\AdminpayrollApiController;
use App\Http\Controllers\Api\Admin\Profile\AdminprofileApiController;
use App\Http\Controllers\Api\Admin\Settings\Academicsetting\Classmaster\ClassmasterApiController;
use App\Http\Controllers\Api\Admin\Settings\Academicsetting\Section\SectionApiController;
use App\Http\Controllers\Api\Admin\Settings\Staffsettings\StaffdepartmentApiController;
use App\Http\Controllers\Api\Admin\Settings\Staffsettings\StaffdesignationApiController;
use App\Http\Controllers\Api\Admin\Staff\Staff\AdminstaffApiController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('v1/login', [AdminauthApiController::class, 'login'])->name('adminapilogin');
Route::post('v1/verifyotp', [AdminauthApiController::class, 'verifyOtp'])->name('verifyotp');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api', 'scopes' => 'admin'], function () {
    //Auth
    Route::controller(AdminauthApiController::class)
        ->group(function () {
            Route::post('admincreatedevicetoken', 'admincreatedevicetoken');
            Route::post('logout', 'logout');
            Route::get('isadminactive', 'isadminactive');
        });

    //Dashboard
    Route::get('dashboard', [AdmindashboardApiController::class, 'dashboard']);
    //Profile
    Route::controller(AdminprofileApiController::class)
        ->group(function () {
            Route::get('getprofile', 'getprofile');
            Route::post('updateprofile', 'updateprofile');
            Route::post('changepassword', 'changepassword');
            Route::post('changeavatar', 'changeavatar');
        });

    //Feed
    Route::controller(AdminfeedpostApiController::class)
        ->group(function () {
            Route::post('admincreatefeedpost', 'admincreatefeedpost');
            Route::post('adminupdatefeedpost', 'adminupdatefeedpost');
            Route::get('admingetallfeedpost', 'admingetallfeedpost');
            Route::get('admingetmyfeedpost', 'admingetmyfeedpost');
            Route::get('admingetalltrendingfeedpost', 'admingetalltrendingfeedpost');
            // Route::post('admingetbyuuidfeedpost', 'admingetbyuuidfeedpost');
            // Route::post('adminstatusupdatefeedpost', 'adminstatusupdatefeedpost');
            Route::post('admindeletefeedpost', 'admindeletefeedpost');
        });

    // //Feed Reported Post
    Route::controller(AdminfeedreportedApiController::class)
        ->group(function () {
            Route::get('admingetallfeedreportedpost', 'admingetallfeedreportedpost');
            Route::post('admingetallreportedbypostuuid', 'admingetallreportedbypostuuid');
            Route::post('adminfeedreportedpoststatusupdate', 'adminfeedreportedpoststatusupdate');
        });

    //Feed Post Vote
    Route::controller(AdminfeedpollApiController::class)
        ->group(function () {
            Route::post('adminfeedpolltoggle', 'adminfeedpolltoggle');
        });

    //Feed Post Stickers
    Route::controller(AdminfeedstickerApiController::class)
        ->group(function () {
            Route::get('admingetallfeedsticker', 'admingetallfeedsticker');
        });

    //Feed Comment
    Route::controller(AdminfeedcommentApiController::class)
        ->group(function () {
            Route::post('admincreatefeedpostcomment', 'admincreatefeedpostcomment');
            Route::post('adminupdatefeedpostcomment', 'adminupdatefeedpostcomment');
            Route::post('admingetallcommentbypostuuid', 'admingetallcommentbypostuuid');
            // Route::post('adminfeedpostcommentstatusupdate', 'adminfeedpostcommentstatusupdate');
            Route::post('admindeletefeedpostcomment', 'admindeletefeedpostcomment');
        });

    //Feed Comment Reply
    Route::controller(AdminfeedcommentreplyApiController::class)
        ->group(function () {
            Route::post('admincreatefeedpostcommentreply', 'admincreatefeedpostcommentreply');
            Route::post('admingetcommentreplybycommentuuid', 'admingetcommentreplybycommentuuid');
            Route::post('admincommentreplyupdatebyuuid', 'admincommentreplyupdatebyuuid');
            // Route::post('admincommentreplystatusupdate', 'admincommentreplystatusupdate');
            Route::post('admincommentreplydelete', 'admincommentreplydelete');
        });

    //Feed Post Like
    Route::controller(AdminfeedpostlikeApiController::class)
        ->group(function () {
            Route::post('adminfeedpostliketoggle', 'adminfeedpostliketoggle');
            Route::post('adminfeedpostlikelist', 'adminfeedpostlikelist');
        });

    //Feed Hashtag
    Route::controller(AdminfeedtagApiController::class)
        ->group(function () {
            Route::get('admingethashtaglist', 'admingethashtaglist');
            Route::post('adminsearchhashtag', 'adminsearchhashtag');
            Route::post('admingetfeedpostbyhashtaguuid', 'admingetfeedpostbyhashtaguuid');
            // Route::post('adminhashtagstatusupdate', 'adminhashtagstatusupdate');
            // Route::post('adminhashtagdelete', 'adminhashtagdelete');
        });

    // // Payroll Process
    // Route::controller(AdminpayrollApiController::class)
    //     ->group(function () {
    //         Route::post('adminstaffpayrollbyuuid', 'adminstaffpayrollbyuuid');
    //         Route::get('adminstaffpayrolldownloadbyuuid/{uuid}', 'adminstaffpayrolldownloadbyuuid'); // Not used yet
    //         Route::get('adminstaffpayrollsendmailbyuuid/{uuid}', 'adminstaffpayrollsendmailbyuuid');
    //     });

    // // Attendance
    // Route::controller(AdminattendanceApiController::class)
    //     ->group(function () {
    //         Route::post('adminstudentattendancelist', 'adminstudentattendancelist');
    //         Route::post('adminstaffattendancelist', 'adminstaffattendancelist');
    //         Route::post('adminleaveapplicationlist', 'adminleaveapplicationlist');
    //         Route::post('adminleavestatusupdate', 'adminleavestatusupdate');
    //     });

    // // Notification
    Route::controller(AdminnotificationApiController::class)
        ->group(function () {
            Route::get('getadminnotification', 'getadminnotification');
            Route::get('adminmarkasreadnotification', 'adminmarkasreadnotification');
            Route::post('getadminnotificationdetails', 'getadminnotificationdetails');
            Route::post('getadminpushnotificationdetails', 'getadminpushnotificationdetails');
        });

    // // Homework
    // Route::controller(AdminhomeworkApiController::class)
    //     ->group(function () {
    //         Route::get('admingetrecenthomeworklist', 'admingetrecenthomeworklist');
    //         Route::post('adminclasssectionwisesubjectlist', 'adminclasssectionwisesubjectlist');
    //         Route::post('adminsubjectwisehomeworklist', 'adminsubjectwisehomeworklist');
    //         Route::post('adminstudentwisehomeworkdetails', 'adminstudentwisehomeworkdetails');
    //         Route::post('adminsubjectwisehomeworkpost', 'adminsubjectwisehomeworkpost');
    //         Route::post('admindownloadhomeworkattachment', 'admindownloadhomeworkattachment');
    //         Route::post('admindownloadstudenthomework', 'admindownloadstudenthomework');
    //         Route::post('adminupdatehomeworkstatus', 'adminupdatehomeworkstatus');
    //         Route::post('admingethomeworkcommentlistbyuuid', 'admingethomeworkcommentlistbyuuid');
    //         Route::post('adminposthomeworkcomment', 'adminposthomeworkcomment');
    //     });
    //Onlineassessment
    Route::controller(AdminonlineassessmentApiController::class)
        ->group(function () {
            Route::get('admingetallclassOA', 'admingetallclassOA');
            Route::post('admingetOAbyclassuuid', 'admingetOAbyclassuuid');
            // Route::post('admingetmarkbystudentnameorrollno', 'admingetmarkbystudentnameorrollno');
            // Route::post('admingetstudentsmarkbyassessmentuuid', 'admingetstudentsmarkbyassessmentuuid');
        });
    //Exam
    // Route::controller(AdminexamApiController::class)
    //     ->group(function () {
    //         Route::post('admingetallexamlistbyclasssectionuuid', 'admingetallexamlistbyclasssectionuuid');
    //         Route::post('admingetexamschedulebyexamuuid', 'admingetexamschedulebyexamuuid');
    //         Route::post('admingetallassignsubjectlist', 'admingetallassignsubjectlist');
    //         Route::post('admingetstudentsmarklistbyclasssectionexamuuid', 'admingetstudentsmarklistbyclasssectionexamuuid');
    //         Route::post('admingetstudentlistbyclasssectionuuid', 'admingetstudentlistbyclasssectionuuid');
    //         Route::post('admingetallexammarkbystudentuuid', 'admingetallexammarkbystudentuuid');
    //     });

    // // Chat
    // Route::controller(AdminchatApiController::class)
    //     ->group(function () {
    //         Route::get('adminchatrecentlist', 'adminchatrecentlist');
    //         Route::get('adminchatgrouplist', 'adminchatgrouplist');
    //         Route::get('adminchatcontactlist', 'adminchatcontactlist');
    //         Route::post('adminchatgroupfilter', 'adminchatgroupfilter');
    //         Route::get('adminchatgroupwisemessagelist/{chatgroup_uuid}', 'adminchatgroupwisemessagelist');
    //         Route::post('adminchatgroupparticipantlist', 'adminchatgroupparticipantlist');
    //         Route::post('adminchatmessagesent', 'adminchatmessagesent');
    //         Route::post('adminchatmessageupdateread', 'adminchatmessageupdateread');
    //     });

    // //Dashboard - Class Routine
    Route::post('getstaffclassroutinebystaffuuid', [AdminstaffclassroutineApiController::class, 'getstaffclassroutinebystaffuuid']);

    // //Setting - Academicsetting
    // Route::get('getallclassmaster', [ClassmasterApiController::class, 'getallclassmaster']);
    // Route::post('getsectionbyclassmasteruuid', [SectionApiController::class, 'getsectionbyclassmasteruuid']);

    // //Class Details
    Route::controller(AdminclassdetailApiController::class)
        ->group(function () {
            Route::post('getclassdetailbyuuid', 'getclassdetailbyuuid');
            // Route::post('classattedancebyclasssectionuuid', 'classattedancebyclasssectionuuid');
            Route::post('getclassroutinebyclassectionuuid', 'getclassroutinebyclassectionuuid');
            // Route::post('getprogressbyclassectionuuid', 'getprogressbyclassectionuuid');
        });

    // //Material
    // Route::controller(AdminmaterialApiController::class)
    //     ->group(function () {
    //         Route::get('getcontenttype', 'getcontenttype');
    //         Route::post('getmaterialsubjectbyclassuuid', 'getmaterialsubjectbyclassuuid');
    //         Route::post('getmaterialbyclassmasteruuid', 'getmaterialbyclassmasteruuid');
    //         Route::post('admincreatematerial', 'admincreatematerial');
    //         Route::post('getmateriallistbymaterialuuid', 'getmateriallistbymaterialuuid');
    //         Route::post('downloadmateriallistbyuuid', 'downloadmateriallistbyuuid');
    //         Route::post('deletemateriallistbyuuid', 'deletemateriallistbyuuid');
    //     });

    // //StaffSetting Department
    // Route::get('getallstaffdepartment', [StaffdepartmentApiController::class, 'getallstaffdepartment']);
    // //StaffSetting Designation
    // Route::get('getallstaffdesignation', [StaffdesignationApiController::class, 'getallstaffdesignation']);
    // //GetStaff
    // Route::post('getstaffbydepartmentuuid', [AdminstaffApiController::class, 'getstaffbydepartmentuuid']);
});
