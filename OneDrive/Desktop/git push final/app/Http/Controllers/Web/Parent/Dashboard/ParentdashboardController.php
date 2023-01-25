<?php

namespace App\Http\Controllers\Web\Parent\Dashboard;

use App\Http\Controllers\Controller;

class ParentdashboardController extends Controller
{
    public function parentdashboard()
    {
        return view('parent.dashboard.dashboard');
    }
}
