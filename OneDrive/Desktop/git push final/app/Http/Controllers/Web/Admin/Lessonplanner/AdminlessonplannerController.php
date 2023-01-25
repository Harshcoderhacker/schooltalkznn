<?php

namespace App\Http\Controllers\Web\Admin\Lessonplanner;

use App\Http\Controllers\Controller;

class AdminlessonplannerController extends Controller
{
    public function adminlessonplanner()
    {
        return view('admin.lessonplanner.index');
    }
    public function adminplanlesson($duelesson_id = null)
    {
        return view('admin.lessonplanner.adminplanlesson', compact('duelesson_id'));
    }

    public function adminprogresstrack()
    {
        return view('admin.lessonplanner.adminprogresstrack');
    }
}
