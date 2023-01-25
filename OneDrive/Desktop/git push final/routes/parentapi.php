<?php

use App\Http\Controllers\Api\Parent\Attendance\ParentattendanceApiController;
use App\Http\Controllers\Api\Parent\Auth\ParentauthApiController;
use App\Http\Controllers\Api\Parent\Chat\ParentchatApiController;
use App\Http\Controllers\Api\Parent\Dashboard\ParentdashboardApiController;
use App\Http\Controllers\Api\Parent\Emotioncapture\EmotioncaptureApiController;
use App\Http\Controllers\Api\Parent\Exam\Offlineexam\ParentofflineexamApiController;
use App\Http\Controllers\Api\Parent\Exam\Onlineexam\ParentonlineexamApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedcommentApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedcommentreplyApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedidealibraryApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedpollApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedpostApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedpostlikeApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedreportedApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedstickerApiController;
use App\Http\Controllers\Api\Parent\Feed\ParentfeedtagApiController;
use App\Http\Controllers\Api\Parent\Fee\ParentfeeApiController;
use App\Http\Controllers\Api\Parent\Gamification\ParentgamificationApiController;
use App\Http\Controllers\Api\Parent\Homework\ParenthomeworkApiController;
use App\Http\Controllers\Api\Parent\Material\ParentmaterialApiController;
use App\Http\Controllers\Api\Parent\Notification\ParentnotificationApiController;
use App\Http\Controllers\Api\Parent\Profile\ParentprofileApiController;
use App\Http\Controllers\Api\Parent\Staffandsubject\ParentstaffandsubjectApiController;
use Illuminate\Support\Facades\Route;

// Auth
Route::post('v1/login', [ParentauthApiController::class, 'login'])->name('parentapilogin');
Route::post('v1/verifyotp', [ParentauthApiController::class, 'verifyOtp'])->name('verifyotp');

Route::group(['prefix' => 'v1', 'middleware' => 'auth:parentapi'], function () {

    //Auth
    Route::controller(ParentauthApiController::class)
        ->group(function () {
            Route::post('parentcreatedevicetoken', 'parentcreatedevicetoken');
            Route::post('logout', 'logout');
            Route::get('isstudentactive', 'isstudentactive');
        });

    // Dashboard
    Route::group(['prefix' => 'dashboard'], function () {
        Route::controller(ParentdashboardApiController::class)
            ->group(function () {
                Route::get('/', 'dashboard');
                Route::get('parentgetstudent', 'parentgetstudent');
                Route::post('parentswapstudent', 'parentswapstudent');
            });
    });

    // Profile
    Route::controller(ParentprofileApiController::class)
        ->group(function () {
            Route::get('getprofile', 'getprofile');
            Route::post('updateprofile', 'updateprofile');
            Route::post('changepassword', 'changepassword');
            Route::post('changeavatar', 'changeavatar');
        });

    //Feed
    Route::controller(ParentfeedpostApiController::class)
        ->group(function () {
            Route::post('parentcreatefeedpost', 'parentcreatefeedpost');
            Route::post('parentupdatefeedpost', 'parentupdatefeedpost');
            Route::get('parentgetallfeedpost', 'parentgetallfeedpost');
            Route::get('parentgetmyfeedpost', 'parentgetmyfeedpost');
            Route::get('parentgetmyclassfeedpost', 'parentgetmyclassfeedpost');
            Route::get('parentgetalltrendingfeedpost', 'parentgetalltrendingfeedpost');
            // Route::post('parentgetbyuuidfeedpost', 'parentgetbyuuidfeedpost');
            // Route::post('parentstatusupdatefeedpost', 'parentstatusupdatefeedpost');
            Route::post('parentdeletefeedpost', 'parentdeletefeedpost');
        });

    //Feed Reported (need to do)
    Route::controller(ParentfeedreportedApiController::class)
        ->group(function () {
            Route::get('parentgetallfeedreportedlist', 'parentgetallfeedreportedlist');
            Route::post('parentfeedreportedstatusupdate', 'parentfeedreportedstatusupdate');
        });

    //Feed Post Vote
    Route::post('parentfeedpolltoggle', [ParentfeedpollApiController::class, 'parentfeedpolltoggle']);

    //Feed Post Stickers
    Route::controller(ParentfeedstickerApiController::class)
        ->group(function () {
            Route::get('parentgetallfeedsticker', 'parentgetallfeedsticker');
        });

    //Feed Comment
    Route::controller(ParentfeedcommentApiController::class)
        ->group(function () {
            Route::post('parentcreatefeedpostcomment', 'parentcreatefeedpostcomment');
            Route::post('parentupdatefeedpostcomment', 'parentupdatefeedpostcomment');
            Route::post('parentgetallcommentbypostuuid', 'parentgetallcommentbypostuuid');
            Route::post('parentgetcommenttempletelist', 'parentgetcommenttempletelist');
            // Route::post('parentfeedpostcommentstatusupdate', 'parentfeedpostcommentstatusupdate');
            Route::post('parentdeletefeedpostcomment', 'parentdeletefeedpostcomment');
        });

    //Feed Comment Reply
    Route::controller(ParentfeedcommentreplyApiController::class)
        ->group(function () {
            Route::post('parentcreatefeedpostcommentreply', 'parentcreatefeedpostcommentreply');
            Route::post('parentgetcommentreplybycommentuuid', 'parentgetcommentreplybycommentuuid');
            Route::post('parentcommentreplyupdatebyuuid', 'parentcommentreplyupdatebyuuid');
            Route::post('parentcommentreplystatusupdate', 'parentcommentreplystatusupdate');
            Route::post('parentcommentreplydelete', 'parentcommentreplydelete');
        });

    //Feed Post Like
    Route::post('parentfeedpostliketoggle', [ParentfeedpostlikeApiController::class, 'parentfeedpostliketoggle']);
    Route::post('parentfeedpostlikelist', [ParentfeedpostlikeApiController::class, 'parentfeedpostlikelist']);

    //Feed Hashtag
    Route::controller(ParentfeedtagApiController::class)
        ->group(function () {
            Route::get('parentgethashtaglist', 'parentgethashtaglist');
            Route::post('parentsearchhashtag', 'parentsearchhashtag');
            Route::post('parentgetfeedpostbyhashtaguuid', 'parentgetfeedpostbyhashtaguuid');
        });

    //Feed Idea Library
    // Route::controller(ParentfeedidealibraryApiController::class)
    //     ->group(function () {
    //         Route::post('parentgetidealibrarylist', 'parentgetidealibrarylist');
    //         Route::post('parentselectidealibrary', 'parentselectidealibrary');
    //         Route::get('parentusedidealibrary', 'parentusedidealibrary');
    //     });

    // Attendance
    // Route::controller(ParentattendanceApiController::class)
    //     ->group(function () {
    //         Route::get('parentattendancemonthlist', 'parentattendancemonthlist');
    //         Route::post('parentmyattendance', 'parentmyattendance');
    //         Route::post('parentapplyleave', 'parentapplyleave');
    //         Route::post('parentdownloadleavereport', 'parentdownloadleavereport');
    //     });

    // Notification
    Route::controller(ParentnotificationApiController::class)
        ->group(function () {
            Route::get('getparentnotification', 'getparentnotification');
            // Route::get('parentmarkasreadnotification', 'parentmarkasreadnotification');
            Route::post('getparentnotificationdetails', 'getparentnotificationdetails');
            Route::post('getparentpushnotificationdetails', 'getparentpushnotificationdetails');
        });

    // Homework
    // Route::controller(ParenthomeworkApiController::class)
    //     ->group(function () {
    //         Route::get('parentgetallhomeworksubject', 'parentgetallhomeworksubject');
    //         Route::post('parentgethomeworksubjectlistbyuuid', 'parentgethomeworksubjectlistbyuuid');
    //         Route::post('parentgethomeworkdetailsbyuuid', 'parentgethomeworkdetailsbyuuid');
    //         Route::post('parentdownloadhomeworkattachment', 'parentdownloadhomeworkattachment');
    //         Route::post('parentposthomeworksubmission', 'parentposthomeworksubmission');
    //         Route::post('parentgethomeworkcommentlistbyuuid', 'parentgethomeworkcommentlistbyuuid');
    //         Route::post('parentposthomeworkcomment', 'parentposthomeworkcomment');
    //     });
    //OffExam
    // Route::controller(ParentofflineexamApiController::class)
    //     ->group(function () {
    //         Route::get('parentexamindex', 'parentexamindex');
    //         Route::get('parentgetexamlist', 'parentgetexamlist');
    //         Route::post('parentgetexamschedulebyexamuuid', 'parentgetexamschedulebyexamuuid');
    //         Route::get('parentgetallexamlistmonthwise', 'parentgetallexamlistmonthwise');
    //         Route::post('parentgetexammarlist', 'parentgetexammarlist');
    //         Route::post('parentgetprogresscard', 'parentgetprogresscard');
    //     });

    //Online Assessment
    // Route::controller(ParentonlineexamApiController::class)
    //     ->group(function () {
    //         Route::get('parenttodayonlineexam', 'parenttodayonlineexam');
    //         Route::get('parentgetassessmentcountsubjectwise', 'parentgetassessmentcountsubjectwise');
    //         Route::post('parentgetallassessmentsubjectwise', 'parentgetallassessmentsubjectwise');
    //         Route::post('parentgetonlineassessment', 'parentgetonlineassessment');
    //         Route::post('parentgetonlineassessmentquestions', 'parentgetonlineassessmentquestions');
    //         Route::post('parentmarksanswer', 'parentmarksanswer');
    //         Route::post('parentsubmitonlineassessment', 'parentsubmitonlineassessment');
    //         Route::post('parentonlineassessmentanswers', 'parentonlineassessmentanswers');
    //     });
    // Fee
    // Route::controller(ParentfeeApiController::class)
    //     ->group(function () {
    //         Route::get('parentfeeindex', 'parentfeeindex');
    //         Route::get('parentpendingfeelist', 'parentpendingfeelist');
    //         Route::post('parentfeepayonline', 'parentfeepayonline');
    //         Route::post('parentfeepaymentstore', 'parentfeepaymentstore');
    //         Route::get('parentfeepaymentinformation', 'parentfeepaymentinformation');
    //         Route::get('parentfeepaymenthistory', 'parentfeepaymenthistory');
    //         Route::post('parentfeepaymentdownload', 'parentfeepaymentdownload');
    //         Route::get('parentfeequery', 'parentfeequery');

    //     });

    // Chat
    // Route::controller(ParentchatApiController::class)
    //     ->group(function () {
    //         Route::get('parentchatrecentlist', 'parentchatrecentlist');
    //         Route::get('parentchatgrouplist', 'parentchatgrouplist');
    //         Route::get('parentchatcontactlist', 'parentchatcontactlist');
    //         Route::post('parentchatgroupfilter', 'parentchatgroupfilter');
    //         Route::get('parentchatgroupwisemessagelist/{chatgroup_uuid}', 'parentchatgroupwisemessagelist');
    //         Route::post('parentchatgroupparticipantlist', 'parentchatgroupparticipantlist');
    //         Route::post('parentchatmessagesent', 'parentchatmessagesent');
    //         Route::post('parentchatmessageupdateread', 'parentchatmessageupdateread');
    //     });

    //Material
    Route::controller(ParentmaterialApiController::class)
        ->group(function () {
            Route::get('parentgetcontenttype', 'parentgetcontenttype');
            // Route::post('parentgetmaterialbycontenttype', 'parentgetmaterialbycontenttype');
            // Route::post('parentgetmateriallistbymaterialuuid', 'parentgetmateriallistbymaterialuuid');
            // Route::post('parentdownloadmaterial', 'parentdownloadmaterial');
        });

    // Gamification
    Route::controller(ParentgamificationApiController::class)
        ->group(function () {
            Route::get('parentgamificationinfo', 'parentgamificationinfo');
            Route::get('parentgamificationgoal', 'parentgamificationgoal');
            Route::get('parentgamificationleaderborad', 'parentgamificationleaderborad');
        });

    //Stff and Subject
    Route::controller(ParentstaffandsubjectApiController::class)
        ->group(function () {
            Route::get('parentstaffdetails', 'parentstaffdetails');
            // Route::get('parentsubjectdetails', 'parentsubjectdetails');
        });

    //Emotion Capture
    Route::controller(EmotioncaptureApiController::class)
        ->group(function () {
            Route::post('parentstoreemotioncapture', 'parentstoreemotioncapture');
            Route::get('parentcheckemotioncapture', 'parentcheckemotioncapture');
            Route::post('parentcalendaremotioncapture', 'parentcalendaremotioncapture');
        });
});
