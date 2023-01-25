<?php

namespace App\Repository\Api\Admin\Businesslogic\Staff\Staff;

use App\Http\Resources\Admin\Staff\Staff\AdminstaffCollection;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Admin\Interfacelayer\Staff\Staff\IAdminstaffApiRepository;

class AdminstaffApiRepository implements IAdminstaffApiRepository
{
    public function getstaffbydepartmentuuid()
    {
        return [true,
            new AdminstaffCollection(
                Staff::whereHas('staffdepartment', fn($q) => $q->where('uuid', request('department_uuid')))
                    ->select('uuid', 'name')
                    ->get()
            ),
            'getstaffbydepartmentuuid'];
    }
}
