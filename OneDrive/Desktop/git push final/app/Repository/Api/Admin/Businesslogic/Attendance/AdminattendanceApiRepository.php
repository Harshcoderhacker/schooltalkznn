<?php

namespace App\Repository\Api\Admin\Businesslogic\Attendance;

use App\Http\Resources\Admin\Attendance\AdminstaffattendancelistResource;
use App\Http\Resources\Admin\Attendance\AdminstudentattendancelistResource;
use App\Http\Resources\Admin\Attendance\Staffleave\AdminstaffleavelistCollection;
use App\Http\Resources\Admin\Attendance\Studentleave\AdminstudentleavelistCollection;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Leave\Studentleaverequest;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Attendance\IAdminattendanceApiRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminattendanceApiRepository implements IAdminattendanceApiRepository
{
    public function adminstudentattendancelist()
    {
        return [true,
            AdminstudentattendancelistResource::collection(Studentattendance::with(['studentattendancelist' =>
                fn($q) => $q->where('absent', true), 'classmaster', 'section', 'studentattendancelist.student'])
                    ->withCount(['studentattendancelist as present_count' => fn($q) => $q->where('present', true)])
                    ->withCount(['studentattendancelist as total_count'])
                    ->whereDate('attendance_date', Carbon::parse(request('attendance_date')))
                    ->whereHas('classmaster', fn($q) => $q->where('uuid', request('classuuid')))
                    ->get()),
            'Success'];
    }

    public function adminstaffattendancelist()
    {
        return [true,
            AdminstaffattendancelistResource::collection(
                Staffattendance::with(['staffattendancelist' =>
                    fn($q) => $q->where('absent', true), 'staffattendancelist.staff', 'staffdesignation'])
                    ->withCount(['staffattendancelist as present_count' => fn($q) => $q->where('present', true)])
                    ->withCount(['staffattendancelist as total_count'])
                    ->whereDate('attendance_date', Carbon::parse(request('attendance_date')))
                    ->whereHas('staffdesignation', fn($q) => $q->where('uuid', request('designation_uuid')))
                    ->get()),
            'Success'];

    }

    public function adminleaveapplicationlist()
    {
        switch (request('type')) {
            case 'student':
                return [true,
                    new AdminstudentleavelistCollection(Studentleaverequest::whereDate('from_date', '>=', Carbon::parse(request('attendance_date')))
                            ->with('student', 'student.classmaster', 'student.section')
                            ->latest()
                            ->paginate(15)),
                    'Success'];
                break;
            case 'staff':
                return [true,
                    new AdminstaffleavelistCollection(Staffleaverequest::with('staff', 'staff.staffdesignation', 'leavetype')
                            ->whereNull('is_approved')
                            ->latest()
                            ->paginate(15)),
                    'Success'];
                break;
            default:
                return [false, 'Invalid Leave Request Post Data'];
        }
    }

    public function adminleavestatusupdate()
    {
        Staffleaverequest::where('uuid', request('staffleaverequestuuid'))->update([
            'is_approved' => request('status'),
        ]);
        Helper::trackmessage(auth()->user(), 'Admin leave status update ', 'adminleavestatusupdate', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, '', 'Success'];
    }
}
