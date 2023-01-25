<?php

namespace App\Repository\Api\Staff\Businesslogic\Dashboard;

use App\Repository\Api\Staff\Interfacelayer\Dashboard\IStaffDashboardApiRepository;

class StaffDashboardApiRepository implements IStaffDashboardApiRepository
{
    public function dashboard()
    {

        return [true, '', 'staff Dassssshboard'];

    }
}
