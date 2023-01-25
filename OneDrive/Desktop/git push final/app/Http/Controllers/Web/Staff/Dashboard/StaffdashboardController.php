<?php

namespace App\Http\Controllers\Web\Staff\Dashboard;

use App\Http\Controllers\Controller;

class StaffdashboardController extends Controller
{
    public function staffdashboard()
    {
        auth()->guard('staff')->user();
        return view('staff.dashboard.dashboard');
    }
}
