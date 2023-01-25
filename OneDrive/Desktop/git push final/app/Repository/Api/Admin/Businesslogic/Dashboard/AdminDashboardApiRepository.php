<?php

namespace App\Repository\Api\Admin\Businesslogic\Dashboard;

use App\Repository\Api\Admin\Interfacelayer\Dashboard\IAdminDashboardApiRepository;
use Auth;

class AdminDashboardApiRepository implements IAdminDashboardApiRepository
{
    public function dashboard()
    {
        return [true, ['dashboard' => [
            'Name' => auth()->user()->name,
            'Totalstudent' => 510,
            'Totalparent' => 267,
            'Totalteacher' => 30,
            'Totalstaff' => 57],
        ], 'Dashboard'];
    }
}
