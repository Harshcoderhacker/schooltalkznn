<?php

namespace App\Http\Controllers\Web\Admin\Report\Attendancereport;

use App\Http\Controllers\Controller;

class StudentattendancereportController extends Controller
{
    public function adminstudentmonthlyattendance()
    {
        return view('admin.report.attendancereport.studentattendancereport.studentmonthlyattendance');
    }

    public function adminstudentoverallattendance()
    {
        return view('admin.report.attendancereport.studentattendancereport.studentoverallattendance');
    }

    public function adminstudentmonthlyattendancedownload()
    {
        return view('admin.report.attendancereport.studentattendancereport.studentmonthlyattendance');
    }

    public function adminstudentoverallattendancedownload()
    {
        return view('admin.report.attendancereport.studentattendancereport.studentoverallattendance');
    }
}
