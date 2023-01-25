<?php

namespace App\Http\Controllers\Web\Staff\Exam;

use App\Http\Controllers\Controller;
use App\Models\Admin\Exam\Offlineexam\Exam;

class StaffexamController extends Controller
{
    public function staffexam()
    {
        return view('staff.exam.staffexamindex');
    }

    public function staffcreateexamindex()
    {
        return view('staff.exam.staffcreateexam.index');
    }

    public function staffcreateexam(Exam $exam)
    {
        $show = 1;
        return view('staff.exam.staffcreateexam.staffcreateexam', compact('exam', 'show'));
    }

    public function staffeditexam(Exam $exam, $show)
    {
        return view('staff.exam.staffcreateexam.staffcreateexam', compact('exam', 'show'));
    }

    public function staffexamattendance()
    {
        return view('staff.exam.staffexamattendance.index');
    }

    public function staffmarkexamattendance($examid, $subjectid, $classmasterid, $sectionid)
    {
        return view('staff.exam.staffexamattendance.staffmarkexamattendance', compact('examid', 'subjectid', 'classmasterid', 'sectionid'));
    }

    public function staffmarkentry()
    {
        return view('staff.exam.markentry.index');
    }

    public function staffdomarkentry($examid, $subjectid, $classmasterid, $sectionid)
    {
        return view('staff.exam.markentry.staffdomarkentry', compact('examid', 'subjectid', 'classmasterid', 'sectionid'));

    }

    public function staffviewmark($examid, $subjectid)
    {
        return view('staff.exam.markentry.staffviewmark', compact('examid', 'subjectid'));
    }

    public function staffonlineassessment()
    {
        return view('staff.exam.assessment.index');
    }

    public function staffcreateonlineassessment()
    {
        return view('staff.exam.assessment.createonlineassessment');
    }

    public function staffassessmentsummary($assessmentid)
    {
        return view('staff.exam.assessment.assessmentsummary', compact('assessmentid'));
    }
}
