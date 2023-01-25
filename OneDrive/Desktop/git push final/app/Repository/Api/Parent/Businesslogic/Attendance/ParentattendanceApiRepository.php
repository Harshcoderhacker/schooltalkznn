<?php

namespace App\Repository\Api\Parent\Businesslogic\Attendance;

use App\Models\Admin\Settings\Schoolsetting\Monthlist;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use App\Models\Admin\Student\Leave\Studentleaverequest;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Attendance\IParentattendanceApiRepository;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ParentattendanceApiRepository implements IParentattendanceApiRepository
{
    public function parentmyattendance()
    {
        $student = Parenthelper::getstudent();

        $monthlist = Monthlist::where('uuid', request('monthlist_uuid'))
            ->first();

        $studentattendance = Studentattendancelist::where('student_id', $student->id)
            ->whereHas('studentattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        return [true,
            [
                'attendance_score' => round(($studentattendance->sum('present') / 26) * 100),
                'total_days' => 26,
                'noofdays_present' => $studentattendance->sum('present'),
                'noofdays_absent' => $studentattendance->sum('absent'),
                'permission' => 0,
                'student_uuid' => $student->uuid,
            ],
            'Success'];
    }

    public function parentattendancemonthlist()
    {
        return [true,
            Monthlist::where('is_futuremonth', false)
                ->select('uuid', 'month_string')
                ->get(),
            'Success'];
    }

    public function parentapplyleave()
    {

        $student = Parenthelper::getstudent();
        $user = auth()->user();

        Studentleaverequest::create([
            'classmaster_id' => $student->classmaster_id,
            'section_id' => $student->section_id,
            'aparent_id' => $user->id,
            'student_id' => $student->id,
            'from_date' => Carbon::parse(request('from_date')),
            'to_date' => Carbon::parse(request('to_date')),
            'reason' => request('reason'),
        ]);

        Helper::trackmessage($user, 'Student Apply Leave ', 'parentapplyleave', substr(request()->header('authorization'), -33), 'API');

        DB::commit();

        return [true, '', 'Success'];
    }

    public function parentdownloadleavereport()
    {

        $student = Parenthelper::getstudent();

        $monthlist = Monthlist::where('uuid', request('monthlist_uuid'))
            ->first();

        $studentattendance = Studentattendancelist::with('studentattendance')
            ->where('student_id', $student->id)
            ->whereHas('studentattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        return Pdf::loadView('admin.student.attendance.pdf.studentattendancereportpdf',
            compact('student', 'monthlist', 'studentattendance'));

    }
}
