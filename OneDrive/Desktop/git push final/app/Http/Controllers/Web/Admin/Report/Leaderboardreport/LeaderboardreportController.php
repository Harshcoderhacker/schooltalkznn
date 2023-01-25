<?php

namespace App\Http\Controllers\Web\Admin\Report\Leaderboardreport;

use App\Http\Controllers\Controller;

class LeaderboardreportController extends Controller
{
    public function classleaderboardreport()
    {
        return view('admin.report.leaderboardreport.classleaderboardreport');
    }
    public function leaderboardclasscomparision()
    {
        return view('admin.report.leaderboardreport.leaderboardclasscomparision');
    }
    public function topstudentleaderboardreport()
    {
        return view('admin.report.leaderboardreport.topstudentleaderboardreport');
    }
    public function staffleaderboardreport()
    {
        return view('admin.report.leaderboardreport.staffleaderboardreport');
    }
}
