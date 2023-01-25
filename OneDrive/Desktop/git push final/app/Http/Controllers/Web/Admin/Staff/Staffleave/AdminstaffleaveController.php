<?php

namespace App\Http\Controllers\Web\Admin\Staff\Staffleave;

use App\Http\Controllers\Controller;

class AdminstaffleaveController extends Controller
{
    public function staffleaverequest()
    {
        return view('admin.staff.attendance.staffleaverequest');
    }

    public function staffapprovedleave()
    {
        return view('admin.staff.attendance.staffapprovedleave');
    }

    public function staffdeclineleave()
    {
        return view('admin.staff.attendance.staffdeclineleave');
    }
}
