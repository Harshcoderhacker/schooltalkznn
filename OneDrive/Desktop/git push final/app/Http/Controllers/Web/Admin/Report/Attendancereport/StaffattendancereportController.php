<?php

namespace App\Http\Controllers\Web\Admin\Report\Attendancereport;

use App\Http\Controllers\Controller;

class StaffattendancereportController extends Controller
{
    public function adminstaffmonthlyattendance()
    {
        return view('admin.report.attendancereport.staffattendancereport.staffmonthlyattendance');
    }

    public function adminstaffoverallattendance()
    {
        return view('admin.report.attendancereport.staffattendancereport.staffoverallattendance');
    }
}
