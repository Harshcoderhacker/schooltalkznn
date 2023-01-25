<?php

namespace App\Http\Controllers\Web\Admin\Class;

use App\Http\Controllers\Controller;

class AdminclassController extends Controller
{
    public function adminclass()
    {
        return view('admin/class/adminclass');
    }

    public function adminclassroutine()
    {
        return view('admin/class/adminclassroutine');
    }

    public function adminclassexam()
    {
        return view('admin/class/adminclassexam');
    }

    public function adminstudentprogress()
    {
        return view('admin/class/adminstudentprogress');
    }
}
