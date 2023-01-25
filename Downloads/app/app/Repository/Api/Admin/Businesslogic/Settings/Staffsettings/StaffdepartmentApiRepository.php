<?php

namespace App\Repository\Api\Admin\Businesslogic\Settings\Staffsettings;

use App\Http\Resources\Admin\Settings\Staffsettings\Staffdepartment\StaffdepartmentCollection;
use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Repository\Api\Admin\Interfacelayer\Settings\Staffsettings\IStaffdepartmentApiRepository;

class StaffdepartmentApiRepository implements IStaffdepartmentApiRepository
{
    public function getallstaffdepartment()
    {
        return [true,
            new StaffdepartmentCollection(Staffdepartment::where('active', true)
                    ->select('uuid', 'name')
                    ->get()),
            'getallstaffdepartment'];
    }
}
