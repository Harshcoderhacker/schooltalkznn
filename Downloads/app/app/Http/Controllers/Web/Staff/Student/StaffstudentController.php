<?php

namespace App\Http\Controllers\Web\Staff\Student;

use App\Http\Controllers\Controller;

class StaffstudentController extends Controller
{
    public function staffstudentindex()
    {
        return view('staff.student.index');
    }

    public function staffstudentinfo()
    {
        return view('staff.student.show');
    }

    public function staffstudentcomplaintspending()
    {
        return view('staff.student.complaint.staffstudentcomplaintspending');
    }

    public function staffstudentcomplaintsresloved()
    {
        return view('staff.student.complaint.staffstudentcomplaintsresloved');
    }

    public function staffstudentleaveindex()
    {
        return view('staff.student.attendance.staffstudentleaveindex');
    }

    public function staffmarkattendance($studentattendanceid)
    {
        return view('staff.student.attendance.staffmarkattendance', compact('studentattendanceid'));
    }

    public function staffstudentleavepending()
    {
        return view('staff.studentleave.staffstudentleavepending');
    }

    public function staffstudentleaveapprove()
    {
        return view('staff.studentleave.staffstudentleaveapprove');
    }
}
