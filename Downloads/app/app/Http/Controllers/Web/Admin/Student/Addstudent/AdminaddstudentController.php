<?php

namespace App\Http\Controllers\Web\Admin\Student\Addstudent;

use App\Http\Controllers\Controller;
use App\Models\Admin\Student\Student;
use Response;

class AdminaddstudentController extends Controller
{

    public function index()
    {
        return view('admin.student.index');
    }

    public function studentdetails(Student $student)
    {
        return view('admin.student.studentdetails', compact('student'));
    }

    public function studentfeedetails(Student $student)
    {
        return view('admin.student.studentfeedetails', compact('student'));
    }
    public function studentattendancedetails(Student $student)
    {
        return view('admin.student.studentattendancedetails', compact('student'));
    }
    public function studentmarksdetails(Student $student)
    {
        return view('admin.student.studentmarksdetails', compact('student'));
    }
    public function studentprogressdetails(Student $student)
    {
        return view('admin.student.studentprogressdetails', compact('student'));
    }

    public function studentdocumentsdetails(Student $student)
    {
        return view('admin.student.studentdocumentsdetails', compact('student'));
    }

    public function studentdetailsdownload()
    {
        return Response::download('storage/' . request('downloadpath'));
    }

    public function addstudent(Student $student)
    {
        $show = 1;
        return view('admin.student.addstudent.addstudent', compact('student', 'show'));
    }

    public function createoreditstudent(Student $student, $show)
    {
        return view('admin.student.addstudent.addstudent', compact('student', 'show'));
    }

    public function studentbulkupload()
    {
        return view('admin.student.bulkuploadstudent.studentbulkupload');
    }
}
