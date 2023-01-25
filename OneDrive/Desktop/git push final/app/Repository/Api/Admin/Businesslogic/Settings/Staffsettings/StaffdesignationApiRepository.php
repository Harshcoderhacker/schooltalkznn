<?php

namespace App\Repository\Api\Admin\Businesslogic\Settings\Staffsettings;

use App\Http\Resources\Admin\Settings\Staffsettings\Staffdesignation\StaffdesignationCollection;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Repository\Api\Admin\Interfacelayer\Settings\Staffsettings\IStaffdesignationApiRepository;

class StaffdesignationApiRepository implements IStaffdesignationApiRepository
{
    public function getallstaffdesignation()
    {
        return [true,
            new StaffdesignationCollection(Staffdesignation::where('active', true)
                    ->select('uuid', 'name')
                    ->get()),
            'getallstaffdesignation'];
    }
}
