<?php

namespace App\Repository\Api\Staff\Businesslogic\Classroutine;

use App\Http\Resources\Common\Classroutine\Staff\StaffclassroutineResource;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Repository\Api\Staff\Interfacelayer\Classroutine\IStaffclassroutineApiRepository;

class StaffclassroutineApiRepository implements IStaffclassroutineApiRepository
{
    public function getstaffclassrountine()
    {
        return [true,
            StaffclassroutineResource::collection(Classroutine::where('active', true)
                    ->with(['stafftimetable' => fn($q) =>
                        $q->where('staff_id', auth()->user()->id),
                    ])
                    ->get()),
            'getstaffclassroutinebystaffuuid'];
    }
}
