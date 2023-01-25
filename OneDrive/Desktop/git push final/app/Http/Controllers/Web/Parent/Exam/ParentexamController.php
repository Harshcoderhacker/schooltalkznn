<?php

namespace App\Http\Controllers\Web\Parent\Exam;

use App\Http\Controllers\Controller;

class ParentexamController extends Controller
{
    public function index()
    {
        return view('parent.exam.index');
    }

    public function parentexammark()
    {
        return view('parent.exam.exammark');
    }
    public function parentprogresscard()
    {
        return view('parent.exam.examprogresscard');
    }

    public function onliveonlineassesment()
    {
        return view('parent.exam.onlineassesment.onlive');
    }

    public function upcomignonlineassesment()
    {
        return view('parent.exam.onlineassesment.upcoming');
    }

    public function completedonlineassesment()
    {
        return view('parent.exam.onlineassesment.completed');
    }

    public function parentattendonlineassessment($onlineassessment_id)
    {
        return view('parent.exam.onlineassesment.takeexam.parentattendonlineassessment', compact('onlineassessment_id'));
    }

}
