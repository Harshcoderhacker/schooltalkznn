<?php

namespace App\Http\Controllers\Web\Staff\Attendance;

use App\Http\Controllers\Controller;
use App\Models\Admin\Staff\Attendance\Staffattendance;

class StaffattendanceController extends Controller
{
    public function staffattendance()
    {
        return view('staff.attendance.staffattendanceindex');
    }
}
