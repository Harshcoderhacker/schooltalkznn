<?php

use App\Http\Controllers\Web\Admin\Accounts\Fee\AdminfeeController;
use App\Http\Controllers\Web\Admin\Auth\AdminauthController;
use App\Http\Controllers\Web\Admin\Class\AdminclassController;
use App\Http\Controllers\Web\Admin\Communication\AdmincommunicationController;
use App\Http\Controllers\Web\Admin\Dashboard\AdmindashboardController;
use App\Http\Controllers\Web\Admin\Exam\AdminexamController;
use App\Http\Controllers\Web\Admin\Feed\AdminfeedController;
use App\Http\Controllers\Web\Admin\Homework\AdminhomeworkController;
use App\Http\Controllers\Web\Admin\Lessonplanner\AdminlessonplannerController;
use App\Http\Controllers\Web\Admin\Materials\AdminmaterialsController;
use App\Http\Controllers\Web\Admin\Parent\AdminparentController;
use App\Http\Controllers\Web\Admin\Report\Accountsreport\Feereport\FeereportController;
use App\Http\Controllers\Web\Admin\Report\AdminreportController;
use App\Http\Controllers\Web\Admin\Report\Attendancereport\StaffattendancereportController;
use App\Http\Controllers\Web\Admin\Report\Attendancereport\StudentattendancereportController;
use App\Http\Controllers\Web\Admin\Report\Emotioncapturereport\EmotioncapturereportController;
use App\Http\Controllers\Web\Admin\Report\Examreport\ExamreportController;
use App\Http\Controllers\Web\Admin\Report\Leaderboardreport\LeaderboardreportController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\AssignsubjectController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\ClassmasterController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\ClassroutineController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\SectionController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\SubjectController;
use App\Http\Controllers\Web\Admin\Settings\Academicsetting\TimetableController;
use App\Http\Controllers\Web\Admin\Settings\AdminsettingsController;
use App\Http\Controllers\Web\Admin\Settings\Broadcast\FcmpushnotificationController;
use App\Http\Controllers\Web\Admin\Settings\Examsetting\ExamgradeController;
use App\Http\Controllers\Web\Admin\Settings\Examsetting\ExampasspercentageController;
use App\Http\Controllers\Web\Admin\Settings\Feedpost\AdminfeedpostsettingsController;
use App\Http\Controllers\Web\Admin\Settings\Feesetting\CoaController;
use App\Http\Controllers\Web\Admin\Settings\Feesetting\FeediscountController;
use App\Http\Controllers\Web\Admin\Settings\Feesetting\FeeparticularController;
use App\Http\Controllers\Web\Admin\Settings\Frontdesksetting\ComplainttypeController;
use App\Http\Controllers\Web\Admin\Settings\Frontdesksetting\PurposeController;
use App\Http\Controllers\Web\Admin\Settings\Frontdesksetting\ReferenceController;
use App\Http\Controllers\Web\Admin\Settings\Frontdesksetting\SourceController;
use App\Http\Controllers\Web\Admin\Settings\Integration\EmailintegrationController;
use App\Http\Controllers\Web\Admin\Settings\Integration\FcmintegrationController;
use App\Http\Controllers\Web\Admin\Settings\Integration\PaymentintegrationController;
use App\Http\Controllers\Web\Admin\Settings\Integration\SmsintegrationController;
use App\Http\Controllers\Web\Admin\Settings\Leavesetting\LeavedefineController;
use App\Http\Controllers\Web\Admin\Settings\Leavesetting\LeavetypeController;
use App\Http\Controllers\Web\Admin\Settings\Logs\AdminuserlogsController;
use App\Http\Controllers\Web\Admin\Settings\Onlineassessment\MapboardController;
use App\Http\Controllers\Web\Admin\Settings\Onlineassessment\MapclassController;
use App\Http\Controllers\Web\Admin\Settings\Onlineassessment\MapsubjectController;
use App\Http\Controllers\Web\Admin\Settings\Profile\AdminprofileController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\AcademicyearController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\EmailtemplateController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\FieldController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\GeneralsettingController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\HolidayController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\LanguageController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\LoginpermissionController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\RoleController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\SmstemplateController;
use App\Http\Controllers\Web\Admin\Settings\Schoolsetting\WeekendController;
use App\Http\Controllers\Web\Admin\Settings\Staffsetting\StaffdepartmentController;
use App\Http\Controllers\Web\Admin\Settings\Staffsetting\StaffdesignationController;
use App\Http\Controllers\Web\Admin\Staff\Addstaff\AdminaddstaffController;
use App\Http\Controllers\Web\Admin\Staff\Payroll\PayrollController;
use App\Http\Controllers\Web\Admin\Staff\Staffattendance\AdminstaffattendanceController;
use App\Http\Controllers\Web\Admin\Staff\Staffleave\AdminstaffleaveController;
use App\Http\Controllers\Web\Admin\Student\Addstudent\AdminaddstudentController;
use App\Http\Controllers\Web\Admin\Student\Promotestudent\AdminpromotestudentController;
use App\Http\Controllers\Web\Admin\Student\Studentattendance\AdminstudentattendanceController;
use App\Http\Controllers\Web\Admin\Student\Studentcomplaint\AdminstudentcomplaintController;
use App\Http\Controllers\Web\Admin\Student\Studentleave\AdminstudentleaveController;
use App\Http\Controllers\Web\Admin\Virtualclass\AdminvirtualclassController;
use Illuminate\Support\Facades\Route;

Route::get('adminloginpage', [AdminauthController::class, 'adminloginpage'])->name('adminloginpage');
Route::get('/adminlogout', [AdminauthController::class, 'adminlogout'])->name('adminlogout');
Route::get('/verifyotp/{email}', [AdminauthController::class, 'verifyotp'])->name('verifyotp');


Route::middleware('auth')->prefix('dashboard')->group(function () {
    Route::get('/admindashboard', [AdmindashboardController::class, 'admindashboard'])->name('admindashboard');
    Route::get('/adminschooltalkzdashboard', [AdmindashboardController::class, 'adminschooltalkzdashboard'])->name('adminschooltalkzdashboard');
    Route::get('/adminemotioncapturedashboard', [AdmindashboardController::class, 'adminemotioncapturedashboard'])->name('adminemotioncapturedashboard');
    Route::get('/admintest', [AdmindashboardController::class, 'admintest'])->name('admintest');
});

Route::middleware('auth')->group(function () {
    //Parent
    Route::controller(AdminparentController::class)
        ->as('adminparent')
        ->group(function () {
            Route::get('adminparent', 'adminparent');
            //Add Parent
            Route::post('adminparentstore', 'store')->name('.store');
        });

    Route::controller(AdminaddstudentController::class)
        ->group(function () {
            Route::get('adminstudent', 'index')->name('adminstudent');
            //Student Details
            Route::get('studentdetails/{student}', 'studentdetails')->name('adminstudentdetails');
            Route::get('studentfeedetails/{student}', 'studentfeedetails')->name('adminstudentfeedetails');
            Route::get('studentattendancedetails/{student}', 'studentattendancedetails')->name('adminstudentattendancedetails');
            Route::get('studentmarksdetails/{student}', 'studentmarksdetails')->name('adminstudentmarksdetails');
            Route::get('studentprogressdetails/{student}', 'studentprogressdetails')->name('adminstudentprogressdetails');
            Route::get('studentdocumentsdetails/{student}', 'studentdocumentsdetails')->name('adminstudentdocumentsdetails');
            //Add Student
            Route::get('addstudent', 'addstudent')->name('addstudent');
            Route::get('createoreditstudent/{student}/{show}', 'createoreditstudent')->name('addstudent.createoreditstudent');
            //Student Details
            Route::get('studentdetails', 'studentdetails')->name('studentdetails');
            Route::post('studentdetailsdownload', 'studentdetailsdownload')->name('studentdetailsdownload');
            //Upload Bulk
            Route::get('studentbulkupload', 'studentbulkupload')->name('studentbulkupload');
        });

    // Route::controller(AdminstudentleaveController::class)
    //     ->group(function () {
            //Leave
            // Route::get('studentpendingleave', 'studentpendingleave')->name('studentpendingleave');
            // Route::get('studentapproveleave', 'studentapproveleave')->name('studentapproveleave');
        // });

    // Route::controller(AdminstudentattendanceController::class)
    //     ->group(function () {
            //Mark Attendance
            // Route::get('markattendance/{studentattendanceid}', 'markattendance')->name('markattendance');
        // });

    // Route::controller(AdminpromotestudentController::class)
    //     ->group(function () {
            //Promote Students
            // Route::get('adminpromotestudents', 'adminpromotestudents')->name('adminpromotestudents');
            //Promote Students by Exam
            // Route::get('adminpromotestudentbyexam', 'adminpromotestudentbyexam')->name('adminpromotestudentbyexam');
        // });

    Route::controller(AdminstudentcomplaintController::class)
        ->group(function () {
            //Complaints
            Route::get('studentcomplaints', 'studentcomplaints')->name('studentcomplaints');
            Route::get('studentcomplaintsresolved', 'studentcomplaintsresolved')->name('studentcomplaintsresolved');
        });

    Route::controller(AdminaddstaffController::class)
        ->group(function () {
            Route::get('adminstaff', 'index')->name('adminstaff');
            Route::get('adminstaffprofileinfo/{staff}', 'adminstaffprofileinfo')->name('adminstaffprofileinfo');
            Route::get('adminstaffpayrollinfo/{staff}', 'adminstaffpayrollinfo')->name('adminstaffpayrollinfo');
            Route::get('adminstaffleaveinfo/{staff}', 'adminstaffleaveinfo')->name('adminstaffleaveinfo');
            Route::get('adminstaffdocumentsinfo/{staff}', 'adminstaffdocumentsinfo')->name('adminstaffdocumentsinfo');
            Route::get('adminstaffclassroutineinfo/{staff}', 'adminstaffclassroutineinfo')->name('adminstaffclassroutineinfo');
            //Add Staff
            Route::get('addstaffinfromation', 'addstaffinfromation')->name('addstaffinfromation');
            Route::get('createoreditstaff/{staff}/{show}', 'createoreditstaff')->name('adminstaff.createoreditstaff');
            Route::post('staffdetailsdownload', 'staffdetailsdownload')->name('staffdetailsdownload');
            Route::get('staffbulkupload', 'staffbulkupload')->name('staffbulkupload');
        });

    Route::controller(AdminstaffleaveController::class)
        ->group(function () {
            //Leave
            Route::get('staffleaverequest', 'staffleaverequest')->name('staffleaverequest');
            Route::get('staffapplyleave', 'staffapplyleave')->name('staffapplyleave');
            Route::get('staffapprovedleave', 'staffapprovedleave')->name('staffapprovedleave');
            Route::get('staffdeclineleave', 'staffdeclineleave')->name('staffdeclineleave');
        });

    Route::controller(AdminstaffattendanceController::class)
        ->group(function () {
            //Attendance
            Route::get('staffattendanceindex', 'staffattendanceindex')->name('staffattendanceindex');
            Route::get('adminstaffmarkattendance/{staffattendanceid}', 'adminstaffmarkattendance')->name('adminstaffmarkattendance');
            //Class Routine
            Route::get('adminstaffclassroutineindex', 'adminstaffclassroutineindex')->name('adminstaffclassroutineindex');
            //Smart Attendance
            Route::get('smartattendanceindex', 'smartattendanceindex')->name('smartattendanceindex');
            Route::get('upcomingsmartattendanceindex', 'upcomingsmartattendanceindex')->name('upcomingsmartattendanceindex');
        });

    //Staff Payroll
    Route::controller(PayrollController::class)
        ->group(function () {
            //Payroll
            Route::get('payroll', 'payroll')->name('payroll');
            //Payroll Staff List
            Route::get('payrollstafflist/{payrollid}', 'payrollstafflist')->name('payrollstafflist');
            //Payroll
            Route::get('staffpaydetails', 'staffpaydetails')->name('staffpaydetails');
            Route::get('generatepayroll/{payrollid}/{staffpayrollid}', 'generatepayroll')->name('generatepayroll');
        });

    //Fees
    Route::controller(AdminfeeController::class)
        ->group(function () {
            Route::get('adminfee', 'index')->name('adminfee');
            Route::get('createadminfeeindex', 'createadminfeeindex')->name('createadminfeeindex');
            //Create Fee
            Route::get('createfee', 'createfee')->name('createfee');
            Route::get('editfee/{feemaster}/{show}', 'editfee')->name('editfee');
            //Fee Collected
            Route::get('feecollected', 'feecollected')->name('feecollected');
            Route::get('feereceipt/{feestudentpayment}', 'feereceipt')->name('feereceipt');
            // Fee Due
            Route::get('feedue', 'feedue')->name('feedue');
            // Fee Waived
            Route::get('feewaived', 'feewaived')->name('feewaived');
            //Student Info
            Route::get('feestudentinfo/{student}', 'feestudentinfo')->name('feestudentinfo');
        });

    //Exams
    Route::controller(AdminexamController::class)
        ->group(function () {
            Route::get('adminexam', 'index')->name('adminexam');
            Route::get('admincreateexamindex', 'admincreateexamindex')->name('admincreateexamindex');
            Route::get('createexam', 'createexam')->name('createexam');
            Route::get('editexam/{exam}/{show}', 'editexam')->name('editexam');

            //Exam Assements
            Route::get('onlineassessment', 'onlineassessment')->name('onlineassessment');
            Route::get('createonlineassessment', 'createonlineassessment')->name('createonlineassessment');
            Route::get('assessmentsummary/{assessmentid}', 'assessmentsummary')->name('assessmentsummary');
            //Exam Attendance
            Route::get('examattendance', 'examattendance')->name('examattendance');
            Route::get('markexamattendance/{examid}/{subjectid}', 'markexamattendance')->name('markexamattendance');
            //Mark Entry
            Route::get('exammarkentry', 'exammarkentry')->name('exammarkentry');
            Route::get('admindomarkentry/{examid}/{subjectid}', 'admindomarkentry')->name('admindomarkentry');
            Route::get('adminviewmark/{examid}/{subjectid}', 'adminviewmark')->name('adminviewmark');
        });

    //Communication
    Route::controller(AdmincommunicationController::class)
        ->group(function () {
            Route::get('admincommuication', 'index')->name('admincommuication');
            //Create Class Group
            Route::get('createclassgroup', 'createclassgroup')->name('createclassgroup');
            //Create Staff Group
            Route::get('createstaffgroup', 'createstaffgroup')->name('createstaffgroup');
        });

    //Home work
    Route::controller(AdminhomeworkController::class)
        ->group(function () {
            Route::get('adminhomework', 'index')->name('adminhomework');
            Route::get('adminhomeworksummary/{homeworkuuid}', 'adminhomeworksummary')->name('adminhomeworksummary');
        });

    //Virtual Class
    Route::controller(AdminvirtualclassController::class)
        ->group(function () {
            Route::get('adminvirtualclass', 'index')->name('adminvirtualclass');
            Route::get('createvirutalmeeting', 'createvirutalmeeting')->name('createvirutalmeeting');
            Route::get('virtualclassschedules', 'virtualclassschedules')->name('virtualclassschedules');
        });

    //Admin Class
    Route::controller(AdminclassController::class)
        ->group(function () {
            Route::get('adminclass', 'adminclass')->name('adminclass');
            Route::get('adminclassroutine', 'adminclassroutine')->name('adminclassroutine');
            Route::get('adminclassexam', 'adminclassexam')->name('adminclassexam');
            Route::get('adminstudentprogress', 'adminstudentprogress')->name('adminstudentprogress');
        });

    //Materials
    Route::controller(AdminmaterialsController::class)
        ->group(function () {
            Route::get('adminmaterials', 'index')->name('adminmaterials');
            //Field
            Route::get('field', 'index')->name('field');
        });

    //Report
    Route::get('/adminreport', [AdminreportController::class, 'adminreport'])->name('adminreport');

    Route::controller(StudentattendancereportController::class)->prefix('report')
        ->group(function () {
            Route::get('/adminstudentmonthlyattendance', 'adminstudentmonthlyattendance')->name('adminstudentmonthlyattendance');
            Route::get('/adminstudentoverallattendance', 'adminstudentoverallattendance')->name('adminstudentoverallattendance');
            Route::get('/adminstudentmonthlyattendancedownload', 'adminstudentmonthlyattendancedownload')->name('adminstudentmonthlyattendancedownload');
            Route::get('/adminstudentoverallattendancedownload', 'adminstudentoverallattendancedownload')->name('adminstudentoverallattendancedownload');
        });

    Route::controller(StaffattendancereportController::class)->prefix('report')
        ->group(function () {
            Route::get('/adminstaffmonthlyattendance', 'adminstaffmonthlyattendance')->name('adminstaffmonthlyattendance');
            Route::get('/adminstaffoverallattendance', 'adminstaffoverallattendance')->name('adminstaffoverallattendance');
            Route::get('/adminstaffmonthlyattendancedownload', 'adminstaffmonthlyattendancedownload')->name('adminstaffmonthlyattendancedownload');
            Route::get('/adminstaffoverallattendancedownload', 'adminstaffoverallattendancedownload')->name('adminstaffoverallattendancedownload');
        });

    Route::controller(FeereportController::class)->prefix('report')
        ->group(function () {
            Route::get('/feestatementreport', 'feestatementreport')->name('feestatementreport');
            Route::get('/feeduereport', 'feeduereport')->name('feeduereport');
            Route::get('/feetransactionreport', 'feetransactionreport')->name('feetransactionreport');
        });

    Route::controller(ExamreportController::class)->prefix('report')
        ->group(function () {
            Route::get('/marksheetreport', 'marksheetreport')->name('marksheetreport');
            Route::get('/classreport', 'classreport')->name('classreport');
            Route::get('/classprogress', 'classprogress')->name('classprogress');
            Route::get('/studentprogress', 'studentprogress')->name('studentprogress');
        });

    Route::controller(AdminfeedController::class)
        ->group(function () {
            Route::get('/adminfeedlatest', 'adminfeedlatest')->name('adminfeedlatest');
            Route::get('/adminfeedtrending', 'adminfeedtrending')->name('adminfeedtrending');
            Route::get('/adminfeedmypost', 'adminfeedmypost')->name('adminfeedmypost');
            Route::get('/adminfeedreportedpost', 'adminfeedreportedpost')->name('adminfeedreportedpost');
            Route::get('/adminfeedhashtag', 'adminfeedhashtag')->name('adminfeedhashtag');
        });

    Route::controller(EmotioncapturereportController::class)
        ->group(function () {
            Route::get('/classemotionratereport', 'classemotionratereport')->name('classemotionratereport');
        });
    Route::controller(LeaderboardreportController::class)
        ->group(function () {
            Route::get('/classleaderboardreport', 'classleaderboardreport')->name('classleaderboardreport');
            Route::get('/leaderboardclasscomparision', 'leaderboardclasscomparision')->name('leaderboardclasscomparision');
            Route::get('/topstudentleaderboardreport', 'topstudentleaderboardreport')->name('topstudentleaderboardreport');
            Route::get('/staffleaderboardreport', 'staffleaderboardreport')->name('staffleaderboardreport');
        });
});

// Settings
Route::middleware('auth')->prefix('settings')->group(function () {
    // Settings
    Route::get('/admin-settings', [AdminsettingsController::class, 'adminsettings'])->name('adminsettings');
    //Feed
    Route::controller(AdminfeedpostsettingsController::class)
        ->group(function () {
            //Tags
            Route::get('tagsettings', 'tagsettings')->name('feedtagsettings');
            //Report
            Route::get('feedreportsettings', 'feedreportsettings')->name('feedreportsettings');
            //Sticker
            Route::get('feedstickersettings', 'feedstickersettings')->name('feedstickersettings');
            //Student Idea Library
            Route::get('feedstudentidealibrarysettings', 'feedstudentidealibrarysettings')->name('feedstudentidealibrarysettings');
            //Idea Library
            Route::get('feedstaffidealibrarysettings', 'feedstaffidealibrarysettings')->name('feedstaffidealibrarysettings');
        });
    Route::resources([
        // Academic Settings
        'section' => SectionController::class,
        'classmaster' => ClassmasterController::class,
        'subject' => SubjectController::class,
        'timetable' => TimetableController::class,
        'assignsubject' => AssignsubjectController::class,
        'classroutine' => ClassroutineController::class,
        //Staff Settings
        'staffdesignation' => StaffdesignationController::class,
        'staffdepartment' => StaffdepartmentController::class,
        //Fees and Expenses
        'feeparticular' => FeeparticularController::class,
        'coa' => CoaController::class,
        'feediscount' => FeediscountController::class,
        // Exam Settings
        'examgrade' => ExamgradeController::class,
        'exampasspercentage' => ExampasspercentageController::class,
        //Leave
        'leavetype' => LeavetypeController::class,
        'leavedefine' => LeavedefineController::class,
        //Front Desk
        'complainttype' => ComplainttypeController::class,
        'purpose' => PurposeController::class,
        'reference' => ReferenceController::class,
        'source' => SourceController::class,
        //Online Assessment
        'mapboard' => MapboardController::class,
        'mapsubject' => MapsubjectController::class,
        'mapclass' => MapclassController::class,
        //Integration
        'paymentintegration' => PaymentintegrationController::class,
        'smsintegration' => SmsintegrationController::class,
        'emailintegration' => EmailintegrationController::class,
        'fcmintegration' => FcmintegrationController::class,
        // Broadcast
        'fcmpushnotification' => FcmpushnotificationController::class,
        //School Settings
        'academicyear' => AcademicyearController::class,
        'emailtemplate' => EmailtemplateController::class,
        'generalsetting' => GeneralsettingController::class,
        'holiday' => HolidayController::class,
        'language' => LanguageController::class,
        'loginpermission' => LoginpermissionController::class,
        'smstemplate' => SmstemplateController::class,
        'weekend' => WeekendController::class,
        'role' => RoleController::class,
        'field' => FieldController::class,
    ]);

    //Lesson Planner
    Route::controller(AdminlessonplannerController::class)
        ->group(function () {
            Route::get('adminlessonplanner', 'adminlessonplanner')->name('adminlessonplanner');
            Route::get('adminplanlesson/{duelesson_id?}', 'adminplanlesson')->name('adminplanlesson');
            Route::get('adminprogresstrack', 'adminprogresstrack')->name('adminprogresstrack');
        });

    //Profile
    Route::controller(AdminprofileController::class)
        ->group(function () {
            Route::get('profile', 'profile')->name('adminprofile');
            Route::get('resetpassword', 'resetpassword')->name('adminresetpassword');
        });

    Route::get('/adminloginlogs', [AdminuserlogsController::class, 'adminloginlogs'])->name('adminloginlogs');
    Route::get('/adminuseractivitylogs', [AdminuserlogsController::class, 'adminuseractivitylogs'])->name('adminuseractivitylogs');
});
