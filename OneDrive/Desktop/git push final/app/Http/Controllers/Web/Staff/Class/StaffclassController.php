<?php

namespace App\Http\Controllers\Web\Staff\Class;

use App\Http\Controllers\Controller;

class StaffclassController extends Controller
{
    public function staffclass()
    {
        return view('staff.class.staffclass');
    }

    public function staffclassroutine()
    {
        return view('staff.class.staffclassroutine');
    }

    public function staffclassexam()
    {
        return view('staff.class.staffclassexam');
    }

    public function staffstudentprogress()
    {
        return view('staff.class.staffstudentprogress');
    }
}
