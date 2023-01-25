<?php

use App\Http\Controllers\Api\Staff\Attendance\StaffattendanceApiController;
use App\Http\Controllers\Api\Staff\Auth\StaffauthApiController;
use App\Http\Controllers\Api\Staff\Chat\StaffchatApiController;
use App\Http\Controllers\Api\Staff\Classattendance\StaffclassattendanceApiController;
use App\Http\Controllers\Api\Staff\Classinfo\StaffclassdetailApiController;
use App\Http\Controllers\Api\Staff\Classroutine\StaffclassroutineApiController;
use App\Http\Controllers\Api\Staff\Dashboard\StaffdashboardApiController;
use App\Http\Controllers\Api\Staff\Exam\Offlineexam\StaffexamApiController;
use App\Http\Controllers\Api\Staff\Exam\Onlineassessment\StaffonlineassessmentApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedcommentApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedcommentreplyApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedidealibraryApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedpollApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedpostApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedpostlikeApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedreportedApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedstickerApiController;
use App\Http\Controllers\Api\Staff\Feed\StafffeedtagApiController;
use App\Http\Controllers\Api\Staff\Gamification\StaffgamificationApiController;
use App\Http\Controllers\Api\Staff\Homework\StaffhomeworkApiController;
use App\Http\Controllers\Api\Staff\Material\StaffmaterialApiController;
use App\Http\Controllers\Api\Staff\Notification\StaffnotificationApiController;
use App\Http\Controllers\Api\Staff\Payroll\StaffpayrollApiController;
use App\Http\Controllers\Api\Staff\Profile\StaffprofileApiController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('v1/login', [StaffauthApiController::class, 'login'])->name('staffapilogin');
Route::post('v1/verifyotp', [StaffauthApiController::class, 'verifyOtp'])->name('verifyotp');

// Driver Login Api
Route::group(['prefix' => 'v1', 'middleware' => 'auth:staffapi', 'scopes' => 'staff'], function () {

    //Auth
    Route::controller(StaffauthApiController::class)
        ->group(function () {
            Route::post('staffcreatedevicetoken', 'staffcreatedevicetoken');
            Route::post('logout', 'logout');
            // Route::post('logout', function () {
            //     return dd('noti');
            // });
            Route::get('isstaffactive', 'isstaffactive');
        });

    // Dashboard
    Route::get('dashboard', [StaffdashboardApiController::class, 'dashboard'])->name('staffapidashboard')->middleware('auth:staffapi', 'scopes:staff');
    // Take Class Attendance
    // Route::controller(StaffclassattendanceApiController::class)
    //     ->group(function () {
    //         Route::get('getclassattendancelist', 'getclassattendancelist');
    //         Route::post('getclassattendancestudentlist', 'getclassattendancestudentlist');
    //         Route::post('markstudentattendance', 'markstudentattendance');
    //         Route::post('getstudentattendancedetail', 'getstudentattendancedetail');
    //     });
    // Profile
    Route::controller(StaffprofileApiController::class)
        ->group(function () {
            Route::get('getprofile', 'getprofile');
            Route::post('updateprofile', 'updateprofile');
            Route::post('changepassword', 'changepassword');
            Route::post('changeavatar', 'changeavatar');
        });
    // Feed
    Route::controller(StafffeedpostApiController::class)
        ->group(function () {
            // Route::post('staffcreatefeedpost', 'staffcreatefeedpost');
            Route::post('staffupdatefeedpost', 'staffupdatefeedpost');
            Route::get('staffgetallfeedpost', 'staffgetallfeedpost');
            Route::get('staffgetmyfeedpost', 'staffgetmyfeedpost');
            Route::get('staffgetalltrendingfeedpost', 'staffgetalltrendingfeedpost');
            // Route::post('staffgetbyuuidfeedpost', 'staffgetbyuuidfeedpost');
            // Route::post('staffstatusupdatefeedpost', 'staffstatusupdatefeedpost');
            Route::post('staffdeletefeedpost', 'staffdeletefeedpost');
        });

    //Feed Reported
    Route::controller(StafffeedreportedApiController::class)
        ->group(function () {
            Route::get('staffgetallfeedreportedpost', 'staffgetallfeedreportedpost');
            Route::post('staffgetallreportedbypostuuid', 'staffgetallreportedbypostuuid');
            Route::post('stafffeedreportedpoststatusupdate', 'stafffeedreportedpoststatusupdate');
        });

    //Feed Post Vote
    Route::controller(StafffeedpollApiController::class)
        ->group(function () {
            Route::post('stafffeedpolltoggle', 'stafffeedpolltoggle');
        });

    //Feed Post Stickers
    Route::controller(StafffeedstickerApiController::class)
        ->group(function () {
            Route::get('staffgetallfeedsticker', 'staffgetallfeedsticker');
        });

    //Feed Idea Library
    // Route::controller(StafffeedidealibraryApiController::class)
    //     ->group(function () {
    //         Route::get('staffgetidealibrarylist', 'staffgetidealibrarylist');
    //         Route::post('staffselectidealibrary', 'staffselectidealibrary');
    //         Route::get('staffusedidealibrary', 'staffusedidealibrary');
    //     });

    //Feed Comment
    Route::controller(StafffeedcommentApiController::class)
        ->group(function () {
            Route::post('staffcreatefeedpostcomment', 'staffcreatefeedpostcomment');
            // Route::post('staffupdatefeedpostcomment', 'staffupdatefeedpostcomment');
            // Route::post('staffgetallcommentbypostuuid', 'staffgetallcommentbypostuuid');
            // Route::post('stafffeedpostcommentstatusupdate', 'stafffeedpostcommentstatusupdate');
            Route::post('staffdeletefeedpostcomment', 'staffdeletefeedpostcomment');
        });

    //Feed Comment Reply
    Route::controller(StafffeedcommentreplyApiController::class)
        ->group(function () {
            Route::post('staffcreatefeedpostcommentreply', 'staffcreatefeedpostcommentreply');
            Route::post('staffgetcommentreplybycommentuuid', 'staffgetcommentreplybycommentuuid');
            Route::post('staffcommentreplyupdatebyuuid', 'staffcommentreplyupdatebyuuid');
            // Route::post('staffcommentreplystatusupdate', 'staffcommentreplystatusupdate');
            Route::post('staffcommentreplydelete', 'staffcommentreplydelete');
        });

    //Feed Post Like
    Route::controller(StafffeedpostlikeApiController::class)
        ->group(function () {
            Route::post('stafffeedpostliketoggle', 'stafffeedpostliketoggle');
            Route::post('stafffeedpostlikelist', 'stafffeedpostlikelist');
        });

    //Feed Hashtag
    Route::controller(StafffeedtagApiController::class)
        ->group(function () {
            Route::get('staffgethashtaglist', 'staffgethashtaglist');
            Route::post('staffsearchhashtag', 'staffsearchhashtag');
            Route::post('staffgetfeedpostbyhashtaguuid', 'staffgetfeedpostbyhashtaguuid');
        });

    //Staff Payroll
    // Route::controller(StaffpayrollApiController::class)
    //     ->group(function () {
    //         Route::get('getstaffpayrolllist', 'getstaffpayrolllist');
    //         Route::post('staffpayrolldownloadbyuuid', 'staffpayrolldownloadbyuuid');
    //     });

    // Attendance
    // Route::controller(StaffattendanceApiController::class)
    //     ->group(function () {
    //         Route::post('staffstudentattendancelist', 'staffstudentattendancelist');
    //         Route::get('staffattendancemonthlist', 'staffattendancemonthlist');
    //         Route::post('staffmyattendance', 'staffmyattendance');
    //         Route::get('staffleavetypelist', 'staffleavetypelist');
    //         Route::post('staffapplyleave', 'staffapplyleave');
    //         Route::post('staffdownloadleavereport', 'staffdownloadleavereport');
    //         Route::get('staffstudentleaverequestlist', 'staffstudentleaverequestlist');
    //     });

    // Notification
    Route::controller(StaffnotificationApiController::class)
        ->group(function () {
            Route::get('getstaffnotification', 'getstaffnotification');
            // Route::get('staffmarkasreadnotification', 'staffmarkasreadnotification');
            Route::post('getstaffnotificationdetails', 'getstaffnotificationdetails');
            Route::post('getstaffpushnotificationdetails', 'getstaffpushnotificationdetails');
        });

    // Homework
    Route::controller(StaffhomeworkApiController::class)
        ->group(function () {
            // Route::get('staffgetrecenthomeworklist', 'staffgetrecenthomeworklist');
            // Route::get('staffclasssectionwisesubjectlist', 'staffclasssectionwisesubjectlist');
            // Route::post('staffsubjectwisehomeworklist', 'staffsubjectwisehomeworklist');
            // Route::post('staffhomeworkdetailsbyuuid', 'staffhomeworkdetailsbyuuid');
            // Route::post('staffsubjectwisehomeworkpost', 'staffsubjectwisehomeworkpost');
            // Route::post('staffdownloadhomeworkattachment', 'staffdownloadhomeworkattachment');
            // Route::post('staffdownloadstudenthomework', 'staffdownloadstudenthomework');
            // Route::post('staffupdatehomeworkstatus', 'staffupdatehomeworkstatus');
            Route::post('staffgethomeworkcommentlistbyuuid', 'staffgethomeworkcommentlistbyuuid');
            Route::post('staffposthomeworkcomment', 'staffposthomeworkcomment');
        });

    //Onlineassessment
    // Route::controller(StaffonlineassessmentApiController::class)
    //     ->group(function () {
    //         Route::get('staffgetallclassOA', 'staffgetallclassOA');
    //         Route::post('staffgetOAbyclassuuid', 'staffgetOAbyclassuuid');
    //         Route::post('staffgetmarkbystudentnameorrollno', 'staffgetmarkbystudentnameorrollno');
    //         Route::post('staffgetstudentsmarkbyassessmentuuid', 'staffgetstudentsmarkbyassessmentuuid');
    //     });
    //Exam
    // Route::controller(StaffexamApiController::class)
    //     ->group(function () {
    //         Route::post('staffgetallexamlistbyclasssectionuuid', 'staffgetallexamlistbyclasssectionuuid');
    //         Route::post('staffgetexamschedulebyexamuuid', 'staffgetexamschedulebyexamuuid');
    //         Route::post('staffgetstudentsmarklistbyclasssectionexamuuid', 'staffgetstudentsmarklistbyclasssectionexamuuid');
    //         Route::post('staffgetstudentlistbyclasssectionuuid', 'staffgetstudentlistbyclasssectionuuid');
    //         Route::post('staffgetallexammarkbystudentuuid', 'staffgetallexammarkbystudentuuid');
    //     });

    // Chat
    // Route::controller(StaffchatApiController::class)
    //     ->group(function () {
    //         Route::get('staffchatrecentlist', 'staffchatrecentlist');
    //         Route::get('staffchatgrouplist', 'staffchatgrouplist');
    //         Route::get('staffchatcontactlist', 'staffchatcontactlist');
    //         Route::post('staffchatgroupfilter', 'staffchatgroupfilter');
    //         Route::get('staffchatgroupwisemessagelist/{chatgroup_uuid}', 'staffchatgroupwisemessagelist');
    //         Route::post('staffchatgroupparticipantlist', 'staffchatgroupparticipantlist');
    //         Route::post('staffchatmessagesent', 'staffchatmessagesent');
    //         Route::post('staffchatmessageupdateread', 'staffchatmessageupdateread');
    //     });

    //Staff Class Routine
    // Route::post('getstaffclassrountine', [StaffclassroutineApiController::class, 'getstaffclassrountine']);

    //Material
    // Route::controller(StaffmaterialApiController::class)
    //     ->group(function () {
    //         Route::get('staffgetcontenttype', 'staffgetcontenttype');
    //         Route::get('staffgetassignedclasslist', 'staffgetassignedclasslist');
    //         Route::post('staffgetmaterialsubjectbyclassuuid', 'staffgetmaterialsubjectbyclassuuid');
    //         Route::post('staffgetmaterialbyclassmasteruuid', 'staffgetmaterialbyclassmasteruuid');
    //         Route::post('staffcreatematerial', 'staffcreatematerial');
    //         Route::post('staffgetmateriallistbymaterialuuid', 'staffgetmateriallistbymaterialuuid');
    //         Route::post('staffdownloadmateriallistbyuuid', 'staffdownloadmateriallistbyuuid');
    //         Route::post('staffdeletemateriallistbyuuid', 'staffdeletemateriallistbyuuid');
    //     });

    //View Class
    // Route::controller(StaffclassdetailApiController::class)
    //     ->group(function () {
    //         Route::get('classteacherclassmaster', 'classteacherclassmaster')->name('classteacherclassmaster');
    //         Route::post('staffclassmasterdetails', 'staffclassmasterdetails')->name('staffclassmasterdetails');
    //         Route::post('staffclassmasterattendancedetails', 'staffclassmasterattendancedetails')->name('staffclassmasterattendancedetails');
    //         Route::post('classteacherclassroutineinfo', 'classteacherclassroutineinfo')->name('classteacherclassroutineinfo');
    //         Route::post('staffgetprogressbyclassectionuuid', 'staffgetprogressbyclassectionuuid')->name('staffgetprogressbyclassectionuuid');
    //     });

    // Gamification
    Route::controller(StaffgamificationApiController::class)
        ->group(function () {
            Route::get('staffgamificationinfo', 'staffgamificationinfo');
            Route::get('staffgamificationgoal', 'staffgamificationgoal');
            Route::get('staffgamificationleaderborad', 'staffgamificationleaderborad');
        });
});
