<?php

namespace App\Http\Controllers\Web\Admin\Student\Studentcomplaint;

use App\Http\Controllers\Controller;

class AdminstudentcomplaintController extends Controller
{
    public function studentcomplaints()
    {
        return view('admin.student.complaints.studentpendingcomplaints');
    }

    public function studentcomplaintsresolved()
    {
        return view('admin.student.complaints.studentcomplaintsresolved');
    }
}
