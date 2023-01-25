<?php

use App\Http\Controllers\Web\Staff\Attendance\StaffattendanceController;
use App\Http\Controllers\Web\Staff\Auth\StaffauthController;
use App\Http\Controllers\Web\Staff\Classroutine\StaffclassroutineController;
use App\Http\Controllers\Web\Staff\Class\StaffclassController;
use App\Http\Controllers\Web\Staff\Communication\StaffcommunicationController;
use App\Http\Controllers\Web\Staff\Dashboard\StaffdashboardController;
use App\Http\Controllers\Web\Staff\Exam\StaffexamController;
use App\Http\Controllers\Web\Staff\Feed\StafffeedController;
use App\Http\Controllers\Web\Staff\Homework\StaffhomeworkController;
use App\Http\Controllers\Web\Staff\Materials\StaffmaterialsController;
use App\Http\Controllers\Web\Staff\Report\StaffreportController;
use App\Http\Controllers\Web\Staff\Student\StaffstudentController;
use App\Http\Controllers\Web\Staff\Virtualclass\StaffvirtualclassController;
use Illuminate\Support\Facades\Route;

Route::get('staffloginpage', [StaffauthController::class, 'staffloginpage'])->name('staffloginpage');
Route::get('/stafflogout', [StaffauthController::class, 'stafflogout'])->name('stafflogout');

Route::middleware('auth.staff')->group(function () {
    Route::get('/staffdashboard', [StaffdashboardController::class, 'staffdashboard'])->name('staffdashboard');

    //Virtual Class
    Route::controller(StaffvirtualclassController::class)
        ->group(function () {
            Route::get('staffvirtualclass', 'staffvirtualclass')->name('staffvirtualclass');
            Route::get('staffcreatevirutalmeeting', 'staffcreatevirutalmeeting')->name('staffcreatevirutalmeeting');
            Route::get('staffvirtualclassschedules', 'staffvirtualclassschedules')->name('staffvirtualclassschedules');
        });

    //Attendance
    Route::get('staffattendance', [StaffattendanceController::class, 'staffattendance'])->name('staffattendance');

    //Class Routine
    Route::get('/staffmyclassroutine', [StaffclassroutineController::class, 'index'])->name('staffmyclassroutine');

    //Communication
    Route::get('/staffcommunication', [StaffcommunicationController::class, 'staffcommunication'])->name('staffcommunication');

    //Exam
    Route::controller(StaffexamController::class)
        ->group(function () {
            Route::get('staffexam', 'staffexam')->name('staffexam');
            //Create Exam
            Route::get('staffcreateexamindex', 'staffcreateexamindex')->name('staffcreateexamindex');
            Route::get('staffcreateexam', 'staffcreateexam')->name('staffcreateexam');
            Route::get('staffeditexam/{exam}/{show}', 'staffeditexam')->name('staffeditexam');
            Route::get('staffconfigureclasses', 'staffconfigureclasses')->name('staffconfigureclasses');
            Route::get('staffsubjectmarks', 'staffsubjectmarks')->name('staffsubjectmarks');
            Route::get('staffclassexamschedule', 'staffclassexamschedule')->name('staffclassexamschedule');
            Route::get('staffexamconfig', 'staffexamconfig')->name('staffexamconfig');
            //Exam Attendance
            Route::get('staffexamattendance', 'staffexamattendance')->name('staffexamattendance');
            Route::get('staffmarkexamattendance/{examid}/{subjectid}/{classmasterid}/{sectionid}', 'staffmarkexamattendance')->name('staffmarkexamattendance');
            //Mark Entry
            Route::get('staffmarkentry', 'staffmarkentry')->name('staffmarkentry');
            Route::get('staffdomarkentry/{examid}/{subjectid}/{classmasterid}/{sectionid}', 'staffdomarkentry')->name('staffdomarkentry');
            Route::get('staffviewmark/{examid}/{subjectid}', 'staffviewmark')->name('staffviewmark');
            //Exam Assements
            Route::get('staffonlineassessment', 'staffonlineassessment')->name('staffonlineassessment');
            Route::get('staffcreateonlineassessment', 'staffcreateonlineassessment')->name('staffcreateonlineassessment');
            Route::get('staffassessmentsummary/{assessmentid}', 'staffassessmentsummary')->name('staffassessmentsummary');
            // //Assessment
            // Route::get('staffquestiongroup', 'staffquestiongroup')->name('staffquestiongroup');
            // Route::get('staffquestionbank', 'staffquestionbank')->name('staffquestionbank');
            // Route::get('staffonlineassesment', 'staffonlineassesment')->name('staffonlineassesment');
            // //Online Assesment
            // Route::get('staffonlineassessmentexaminfo', 'staffonlineassessmentexaminfo')->name('staffonlineassessmentexaminfo');
            // Route::get('staffmanagequestion', 'staffmanagequestion')->name('staffmanagequestion');
            // Route::get('staffassessmentexamschedule', 'staffassessmentexamschedule')->name('staffassessmentexamschedule');
            // Route::get('staffassessmentexamconfiguration', 'staffassessmentexamconfiguration')->name('staffassessmentexamconfiguration');
        });

    //Student
    Route::controller(StaffstudentController::class)
        ->group(function () {
            Route::get('staffstudentindex', 'staffstudentindex')->name('staffstudentindex');
            Route::get('staffstudentinfo', 'staffstudentinfo')->name('staffstudentinfo');
            //Attendance
            Route::get('staffstudentleaveindex', 'staffstudentleaveindex')->name('staffstudentleaveindex');
            Route::get('staffmarkattendance/{studentattendanceid}', 'staffmarkattendance')->name('staffmarkattendance');
            //Leave
            Route::get('staffstudentleavepending', 'staffstudentleavepending')->name('staffstudentleavepending');
            Route::get('staffstudentleaveapprove', 'staffstudentleaveapprove')->name('staffstudentleaveapprove');
            //Complaint
            Route::get('staffstudentcomplaintspending', 'staffstudentcomplaintspending')->name('staffstudentcomplaintspending');
            Route::get('staffstudentcomplaintsresloved', 'staffstudentcomplaintsresloved')->name('staffstudentcomplaintsresloved');
        });

    //Homework
    Route::controller(StaffhomeworkController::class)
        ->group(function () {
            Route::get('staffhomework', 'staffhomework')->name('staffhomework');
            Route::get('staffhomeworksummary/{homeworkuuid}', 'staffhomeworksummary')->name('staffhomeworksummary');
        });

    //Staff Class
    Route::controller(StaffclassController::class)
        ->group(function () {
            Route::get('staffclass', 'staffclass')->name('staffclass');
            Route::get('staffclassroutine', 'staffclassroutine')->name('staffclassroutine');
            Route::get('staffclassexam', 'staffclassexam')->name('staffclassexam');
            Route::get('staffstudentprogress', 'staffstudentprogress')->name('staffstudentprogress');
        });

    //Feed
    Route::controller(StafffeedController::class)
        ->group(function () {
            Route::get('stafffeedlatest', 'stafffeedlatest')->name('stafffeedlatest');
            Route::get('stafffeedtrending', 'stafffeedtrending')->name('stafffeedtrending');
            Route::get('stafffeedmypost', 'stafffeedmypost')->name('stafffeedmypost');
        });

    //StaffMaterials
    Route::get('/staffmaterials', [StaffmaterialsController::class, 'staffmaterials'])->name('staffmaterials');
    //Report
    Route::get('/staffreport', [StaffreportController::class, 'staffreport'])->name('staffreport');

});
