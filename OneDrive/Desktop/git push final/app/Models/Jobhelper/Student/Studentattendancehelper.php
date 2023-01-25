<?php

namespace App\Models\Jobhelper\Student;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Studentattendancehelper extends Model
{
    public static function generateattendancerecord($attendancedate)
    {

        $holidaystatus = Helper::holidaystatus($attendancedate);

        $classmaster = Classmaster::where('active', true)->get();
        foreach ($classmaster as $classkey => $eachclass) {
            $section = $eachclass->section->where('active', true);
            foreach ($section as $sectionkey => $eachsection) {
                $studentattendance = Studentattendance::create([
                    'classmaster_id' => $eachclass->id,
                    'section_id' => $eachsection->id,
                    'attendance_date' => $attendancedate,
                    'is_holiday' => $holidaystatus,
                ]);

                $academicyear_id = App::make('generalsetting')->academicyear_id;
                $student = Student::where('active', true)
                    ->where('academicyear_id', $academicyear_id)
                    ->where('classmaster_id', $eachclass->id)
                    ->where('section_id', $eachsection->id)
                    ->select('id')
                    ->get();

                foreach ($student as $studentkey => $eachstudent) {
                    $studentattendance->studentattendancelist()
                        ->create([
                            'student_id' => $eachstudent->id,
                            'academicyear_id' => $academicyear_id,
                            'month_string' => $attendancedate->format("F Y"),
                            'is_holiday' => $holidaystatus,
                        ]);
                }
            }
        }
    }
}
