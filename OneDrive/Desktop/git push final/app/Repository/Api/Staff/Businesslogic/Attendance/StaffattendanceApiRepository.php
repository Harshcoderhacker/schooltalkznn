<?php

namespace App\Repository\Api\Staff\Businesslogic\Attendance;

use App\Http\Resources\Staff\Attendance\Leave\StaffstudentleavelistCollection;
use App\Http\Resources\Staff\Attendance\StaffstudentattendancelistResource;
use App\Models\Admin\Settings\Leavesetting\Leavetype;
use App\Models\Admin\Settings\Schoolsetting\Monthlist;
use App\Models\Admin\Staff\Attendance\Staffattendancelist;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Leave\Studentleaverequest;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Attendance\IStaffattendanceApiRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class StaffattendanceApiRepository implements IStaffattendanceApiRepository
{
    public function staffstudentattendancelist()
    {
        return [true,
            StaffstudentattendancelistResource::collection(Studentattendance::with(['studentattendancelist' =>
                fn($q) => $q->where('absent', true), 'classmaster', 'section', 'studentattendancelist.student'])
                    ->withCount(['studentattendancelist as present_count' => fn($q) => $q->where('present', true)])
                    ->withCount(['studentattendancelist as total_count'])
                    ->whereDate('attendance_date', Carbon::parse(request('attendance_date')))
                // ->whereHas('classmaster', fn($q) => $q->where('uuid', request('classuuid')))
                    ->get()),
            'Success'];
    }

    public function staffattendancemonthlist()
    {
        return [true,
            Monthlist::where('is_futuremonth', false)
                ->select('uuid', 'month_string')
                ->get(),
            'Success'];
    }

    public function staffmyattendance()
    {
        $user = auth()->user();

        $monthlist = Monthlist::where('uuid', request('monthlist_uuid'))
            ->first();

        $staffattendance = Staffattendancelist::where('staff_id', $user->id)
            ->whereHas('staffattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        return [true,
            [
                'attendance_score' => round(($staffattendance->sum('present') / 26) * 100),
                'total_days' => 26,
                'noofdays_present' => $staffattendance->sum('present'),
                'noofdays_absent' => $staffattendance->sum('absent'),
                'permission' => 0,
                'staff_uuid' => $user->uuid,
            ],
            'Success'];
    }

    public function staffleavetypelist()
    {
        return [true,
            Leavetype::where('active', true)
                ->select('uuid', 'name')
                ->get(),
            'Success'];
    }

    public function staffapplyleave()
    {

        $user = auth()->user();

        Staffleaverequest::create([
            'staff_id' => $user->id,
            'leavetype_id' => Leavetype::where('uuid', request('leavetype_uuid'))->first()->id,
            'from_date' => Carbon::parse(request('from_date')),
            'to_date' => Carbon::parse(request('to_date')),
            'reason' => request('reason'),
        ]);
        Helper::trackmessage($user, 'Staff Leave Request Create ', 'staffapplyleave', substr(request()->header('authorization'), -33), 'API');
        DB::commit();

        return [true, '', 'Success'];
    }

    public function staffdownloadleavereport()
    {
        $staff = auth()->user();

        $monthlist = Monthlist::where('uuid', request('monthlist_uuid'))
            ->first();

        $staffattendance = Staffattendancelist::where('staff_id', $staff->id)
            ->whereHas('staffattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        return Pdf::loadView('admin.staff.attendance.pdf.staffattendancereportpdf',
            compact('staff', 'monthlist', 'staffattendance'));

    }

    public function staffstudentleaverequestlist()
    {
        return [true,
            new StaffstudentleavelistCollection(Studentleaverequest::with('classmaster', 'section', 'student')
                    ->latest()
                    ->paginate(10)),
            'Success'];
    }
}
