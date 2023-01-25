<?php

namespace App\Http\Controllers\Web\Parent\Attendance;

use App\Http\Controllers\Controller;

class ParentattendanceController extends Controller
{
    public function index()
    {
        return view('parent.attendance.index');
    }
}
