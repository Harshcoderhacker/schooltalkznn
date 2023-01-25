<?php

namespace App\Http\Controllers\Web\Staff\Homework;

use App\Http\Controllers\Controller;

class StaffhomeworkController extends Controller
{
    public function staffhomework()
    {
        return view('staff.homework.index');
    }

    public function staffhomeworksummary($homeworkuuid)
    {
        return view('staff.homework.staffhomeworksummary', compact('homeworkuuid'));
    }
}
