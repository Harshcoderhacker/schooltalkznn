<?php

namespace App\Http\Controllers\Web\Admin\Report;

use App\Http\Controllers\Controller;

class AdminreportController extends Controller
{
    public function adminreport()
    {
        return view('admin.report.index');
    }
}
