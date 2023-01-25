<?php

namespace App\Repository\Api\Parent\Businesslogic\Dashboard;

use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use App\Repository\Api\Parent\Interfacelayer\Dashboard\IParentDashboardApiRepository;
use DB;

class ParentDashboardApiRepository implements IParentDashboardApiRepository
{
    public function dashboard()
    {
        return [true, '', 'Dashboard'];
    }

    public function parentgetstudent()
    {

        $student = Student::where('active', true)
            ->where('aparent_id', auth()->user()->id)
            ->select('name', 'uuid')
            ->get();

        return [true, ['student' => $student], 'parentgetstudent'];
    }

    public function parentswapstudent()
    {
        $student = Student::where('active', true)->where('uuid', request('studentuuid'))->first();

        Parentappactivestudent::updateOrCreate([
            'parenttokenid' => substr(request()->header('authorization'), -33) . auth()->user()->uuid,
        ], [
            'student_id' => $student->id,
            'student_uuid' => $student->uuid,
            'aparent_id' => auth()->user()->id,
            'type' => "api",
            'parenttokenid' => substr(request()->header('authorization'), -33) . auth()->user()->uuid,
        ]);

        Helper::trackmessage(auth()->user(), 'Parent Swap Student ', 'parent_api_parentswapstudent',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        return [true, ['studentuuid' => $student->uuid], 'parentswapstudent'];
    }
}
