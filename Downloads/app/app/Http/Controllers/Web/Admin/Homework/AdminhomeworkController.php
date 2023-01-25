<?php

namespace App\Http\Controllers\Web\Admin\Homework;

use App\Http\Controllers\Controller;

class AdminhomeworkController extends Controller
{
    public function index()
    {
        return view('admin.homework.index');
    }

    public function adminhomeworksummary($homeworkuuid)
    {
        return view('admin.homework.homeworksummary', compact('homeworkuuid'));
    }
}
