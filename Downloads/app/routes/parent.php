<?php

use App\Http\Controllers\Web\Parent\Attendance\ParentattendanceController;
use App\Http\Controllers\Web\Parent\Auth\ParentauthController;
use App\Http\Controllers\Web\Parent\Classroutine\ParentclassrountineclassController;
use App\Http\Controllers\Web\Parent\Communication\ParentcommunicationController;
use App\Http\Controllers\Web\Parent\Dashboard\ParentdashboardController;
use App\Http\Controllers\Web\Parent\Exam\ParentexamController;
use App\Http\Controllers\Web\Parent\Feed\AparentfeedController;
use App\Http\Controllers\Web\Parent\Fee\ParentfeeController;
use App\Http\Controllers\Web\Parent\Homework\ParenthomeworkclassController;
use App\Http\Controllers\Web\Parent\Material\ParentmaterialclassController;
use App\Http\Controllers\Web\Parent\Virtualclass\ParentvirtualclassController;
use Illuminate\Support\Facades\Route;

Route::get('parentloginpage', [ParentauthController::class, 'parentloginpage'])->name('parentloginpage');
Route::get('/parentlogout', [ParentauthController::class, 'parentlogout'])->name('parentlogout');

Route::middleware('auth.parent')->group(function () {
    Route::get('/parentdashboard', [ParentdashboardController::class, 'parentdashboard'])->name('parentdashboard');

    //Communication
    Route::get('/parentcommunication', [ParentcommunicationController::class, 'parentcommunication'])->name('parentcommunication');

    //Virtual Class
    Route::controller(ParentvirtualclassController::class)
        ->group(function () {
            Route::get('parentvirtualclasstoday', 'parentvirtualclasstoday')->name('parentvirtualclasstoday');
            Route::get('parentvirtualclassupcoming', 'parentvirtualclassupcoming')->name('parentvirtualclassupcoming');
        });

    //Fee
    Route::controller(ParentfeeController::class)
        ->group(function () {
            Route::get('parentfee', 'parentfee')->name('parentfee');
            Route::get('parentfeeinvoice', 'parentfeeinvoice')->name('parentfeeinvoice');
            Route::post('parentfeepaymentstore', 'parentfeepaymentstore')->name('parentfeepaymentstore');
        });

    //Homework
    Route::controller(ParenthomeworkclassController::class)
        ->group(function () {
            Route::get('parenthomework', 'index')->name('parenthomework');
            Route::get('homeworksummary/{homeworkid}', 'homeworksummary')->name('homeworksummary');
        });

    //Materials
    Route::get('/parentmaterial', [ParentmaterialclassController::class, 'index'])->name('parentmaterial');

    //Class Routine
    Route::get('/parentclassrountine', [ParentclassrountineclassController::class, 'index'])->name('parentclassrountine');

    //Examination
    Route::controller(ParentexamController::class)
        ->group(function () {
            Route::get('parentexam', 'index')->name('parentexam');
            Route::get('parentexammark', 'parentexammark')->name('parentexammark');
            Route::get('parentprogresscard', 'parentprogresscard')->name('parentprogresscard');
        });

    //Online Assesment
    Route::controller(ParentexamController::class)
        ->group(function () {
            Route::get('parentonliveonlineassesment', 'onliveonlineassesment')->name('parentonliveonlineassesment');
            Route::get('parentoupcomingonlineassesment', 'upcomignonlineassesment')->name('parentoupcomingonlineassesment');
            Route::get('parentcompletedonlineassesment', 'completedonlineassesment')->name('parentcompletedonlineassesment');
            Route::get('parentattendonlineassessment/{onlineassessment_id}', 'parentattendonlineassessment')->name('parentattendonlineassessment');
        });

    //Feed
    Route::controller(AparentfeedController::class)
        ->group(function () {
            Route::get('aparentfeedlatest', 'aparentfeedlatest')->name('aparentfeedlatest');
            Route::get('aparentfeedtrending', 'aparentfeedtrending')->name('aparentfeedtrending');
            Route::get('aparentfeedmypost', 'aparentfeedmypost')->name('aparentfeedmypost');
            Route::get('aparentfeedmyclass', 'aparentfeedmyclass')->name('aparentfeedmyclass');
        });

    //Attendance
    Route::get('/parentattendance', [ParentattendanceController::class, 'index'])->name('parentattendance');
});
