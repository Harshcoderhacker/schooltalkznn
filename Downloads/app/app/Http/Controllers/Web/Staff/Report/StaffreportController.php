<?php

namespace App\Http\Controllers\Web\Staff\Report;

use App\Http\Controllers\Controller;

class StaffreportController extends Controller
{
    public function staffreport()
    {
        return view('staff/report/index');
    }
}
