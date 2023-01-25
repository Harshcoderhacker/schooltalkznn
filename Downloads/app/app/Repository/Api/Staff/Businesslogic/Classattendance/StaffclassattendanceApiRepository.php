<?php

namespace App\Repository\Api\Staff\Businesslogic\Classattendance;

use App\Http\Resources\Staff\Classattendance\Classattendancedetail\ClassattendancedetailResource;
use App\Http\Resources\Staff\Classattendance\Classattendancelist\StaffclassattendancelistResource;
use App\Http\Resources\Staff\Classattendance\Classattendancestudentlist\StaffclassattendancestudentlistResource;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Classattendance\IStaffclassattendanceApiRepository;
use Carbon\Carbon;
use id;
use Illuminate\Support\Facades\DB;

class StaffclassattendanceApiRepository implements IStaffclassattendanceApiRepository
{
    public function getclassattendancelist()
    {
        $user = auth()->user();
        $studentattendanceid = [];
        $today = strtolower(Carbon::today()->format('l'));

        $assignsubjectclassteacher = Assignsubject::where('staff_id', $user->id)
            ->where('is_classteacher', true)
            ->get();
        if (count($assignsubjectclassteacher) > 0) {
            foreach ($assignsubjectclassteacher as $eachvalue) {
                array_push($studentattendanceid, Studentattendance::where('classmaster_id', $eachvalue->classmaster->id)
                        ->where('section_id', $eachvalue->section->id)
                        ->where('attendance_date', Carbon::today())
                        ->first()?->id);
            }
        }
        $stafftimetable = Stafftimetable::where('staff_id', $user->id)
            ->where('classroutine_id', 1)
            ->whereNotNull($today)
            ->first();
        if ($stafftimetable) {
            $assignsubject = Assignsubject::find($stafftimetable->$today);
            array_push($studentattendanceid, Studentattendance::where('classmaster_id', $assignsubject->classmaster->id)
                    ->where('section_id', $assignsubject->section->id)
                    ->where('attendance_date', Carbon::today())
                    ->first()?->id);
        }
        $studentattendance = Studentattendance::whereIn('id', $studentattendanceid)->get();
        return [true, StaffclassattendancelistResource::collection($studentattendance), 'getclassattendancelist'];
    }

    public function getclassattendancestudentlist()
    {
        $studetattendancelist = Studentattendance::where('uuid', request('studentattendance_uuid'))
            ->first()
            ->studentattendancelist;

        return [true, StaffclassattendancestudentlistResource::collection($studetattendancelist), 'getclassattendancestudentlist'];
    }

    public function markstudentattendance()
    {
        $studentattendancelist = Studentattendancelist::where('uuid', request('studentattendancelist_uuid'))->first();
        $field = request('field');
        $studentattendancelist->present = ($field == 'present') ? true : false;
        $studentattendancelist->late = ($field == 'late') ? true : false;
        $studentattendancelist->absent = ($field == 'absent') ? true : false;
        $studentattendancelist->halfday = ($field == 'halfday') ? true : false;
        $studentattendancelist->save();
        $this->markedby($studentattendancelist->studentattendance->id);

        $totalpresent = $studentattendancelist->studentattendance->presentstudent->count();
        $totalstudent = $studentattendancelist->studentattendance->studentattendancelist->count();
        $percent = $totalpresent / $totalstudent * 100;
        $studentattendancelist->studentattendance->attendance_percentage = $percent;
        $studentattendancelist->studentattendance->save();

        Helper::trackmessage(auth()->user(), 'Staff Mark Attendance', 'staff_api_mark_student_attendance', substr(request()->header('authorization'), -33), 'API');

        DB::commit();
        return [true, "", 'markstudentattendance'];
    }

    public function getstudentattendancedetail()
    {
        return [true, new ClassattendancedetailResource(Studentattendance::where('uuid', request('studentattendance_uuid'))
                ->first()), 'getstudentattendancedetail'];
    }

    protected function markedby($studentattendanceid)
    {
        $studentattendance = Studentattendance::find($studentattendanceid);
        if (!$studentattendance->marked_id) {
            $studentattendance->marked_id = auth()->user()->id;
            $studentattendance->usertype = 'STAFF';
            $studentattendance->attendance_status = true;
            $studentattendance->save();
        }
    }
}
