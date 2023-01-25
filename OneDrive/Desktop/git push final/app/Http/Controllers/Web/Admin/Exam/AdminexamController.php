<?php

namespace App\Http\Controllers\Web\Admin\Exam;

use App\Http\Controllers\Controller;
use App\Models\Admin\Exam\Offlineexam\Exam;

class AdminexamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.exam.index');
    }

    public function admincreateexamindex()
    {
        return view('admin.exam.createexam.index');
    }

    public function createexam(Exam $exam)
    {
        $show = 1;
        return view('admin.exam.createexam.createexam', compact('exam', 'show'));
    }

    public function editexam(Exam $exam, $show)
    {
        return view('admin.exam.createexam.createexam', compact('exam', 'show'));
    }

    public function examattendance()
    {
        return view('admin.exam.examattendance.index');
    }

    public function markexamattendance($examid, $subjectid)
    {
        return view('admin.exam.examattendance.markexamattendance', compact('examid', 'subjectid'));
    }

    public function exammarkentry()
    {
        return view('admin.exam.exammarkentry.index');
    }

    public function admindomarkentry($examid, $subjectid)
    {
        return view('admin.exam.exammarkentry.adminentrymark', compact('examid', 'subjectid'));
    }

    public function adminviewmark($examid, $subjectid)
    {
        return view('admin.exam.exammarkentry.adminviewmark', compact('examid', 'subjectid'));
    }

    public function onlineassessment()
    {
        return view('admin.exam.assessment.index');
    }

    public function createonlineassessment()
    {
        return view('admin.exam.assessment.createonlineassessment');
    }

    public function assessmentsummary($assessmentid)
    {
        return view('admin.exam.assessment.assessmentsummary', compact('assessmentid'));
    }

}
