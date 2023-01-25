<?php

namespace App\Models\Jobhelper\Staff;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Staffattendancehelper extends Model
{
    public static function generateattendancerecord($attendancedate)
    {

        $holidaystatus = Helper::holidaystatus($attendancedate);

        $designation = Staffdesignation::where('active', true)->get();
        foreach ($designation as $designationkey => $eachdesignation) {

            $staffattendance = Staffattendance::create([
                'staffdesignation_id' => $eachdesignation->id,
                'attendance_date' => $attendancedate,
                'is_holiday' => $holidaystatus,
            ]);

            $staff = Staff::where('active', true)
                ->where('staffdesignation_id', $eachdesignation->id)
                ->select('id')
                ->get();

            foreach ($staff as $staffkey => $eachstaff) {
                $staffleaverequest = Staffleaverequest::where('staff_id', $eachstaff->id)->where('is_approved', true)
                    ->whereDate('from_date', '<=', $staffattendance->attendance_date)
                    ->whereDate('to_date', '>=', $staffattendance->attendance_date)->pluck('staff_id')->toArray();
                if (in_array($eachstaff->id, $staffleaverequest)) {
                    $staffattendance->staffattendancelist()
                        ->create([
                            'staff_id' => $eachstaff->id,
                            'academicyear_id' => App::make('generalsetting')->academicyear_id,
                            'present' => false,
                            'late' => false,
                            'halfday' => false,
                            'absent' => true,
                            'note' => 'Staff is in Leave',
                            'month_string' => date('F Y', strtotime($staffattendance->attendance_date)),
                            'is_holiday' => $holidaystatus,
                        ]);
                } else {
                    $staffattendance->staffattendancelist()
                        ->create([
                            'staff_id' => $eachstaff->id,
                            'academicyear_id' => App::make('generalsetting')->academicyear_id,
                            'month_string' => $attendancedate->format("F Y"),
                            'is_holiday' => $holidaystatus,
                        ]);
                }
            }
        }

    }
}
