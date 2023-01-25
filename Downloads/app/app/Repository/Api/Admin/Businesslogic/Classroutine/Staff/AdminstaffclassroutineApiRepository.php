<?php

namespace App\Repository\Api\Admin\Businesslogic\Classroutine\Staff;

use App\Http\Resources\Common\Classroutine\Staff\StaffclassroutineResource;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Admin\Interfacelayer\Classroutine\Staff\IAdminstaffclassroutineApiRepository;

class AdminstaffclassroutineApiRepository implements IAdminstaffclassroutineApiRepository
{
    public function getstaffclassroutinebystaffuuid()
    {
        return [true,
            StaffclassroutineResource::collection(Classroutine::where('active', true)
                    ->with(['stafftimetable' => fn($q) =>
                        $q->where('staff_id', Staff::where('uuid', request('staffuuid'))->first()->id),
                    ])
                    ->get()),
            'getstaffclassroutinebystaffuuid'];
    }
}
