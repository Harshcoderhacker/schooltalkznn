<?php

namespace App\Http\Controllers\Web\Admin\Staff\Staffattendance;

use App\Http\Controllers\Controller;

class AdminstaffattendanceController extends Controller
{
    public function staffattendanceindex()
    {
        return view('admin.staff.attendance.staffattendanceindex');
    }

    public function adminstaffmarkattendance($staffattendanceid)
    {
        return view('admin.staff.attendance.staffmarkattendance', compact('staffattendanceid'));
    }

    public function adminstaffclassroutineindex()
    {
        return view('admin.staff.classroutine.adminstaffclassroutineindex');
    }

    public function smartattendanceindex()
    {
        return view('admin.staff.smartattendance.smartattendanceindex');
    }

    public function upcomingsmartattendanceindex()
    {
        return view('admin.staff.smartattendance.upcomingsmartattendanceindex');
    }
}
