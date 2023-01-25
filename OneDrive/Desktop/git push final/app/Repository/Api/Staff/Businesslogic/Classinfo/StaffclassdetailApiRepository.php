<?php

namespace App\Repository\Api\Staff\Businesslogic\Classinfo;

use App\Http\Resources\Admin\Class\Classroutine\ClassroutineResource;
use App\Http\Resources\Staff\Classinfo\Attendance\StaffclassstaffattendancedetailResource;
use App\Http\Resources\Staff\Classinfo\Attendance\StaffclassstudentattendancedetailResource;
use App\Http\Resources\Staff\Classinfo\Classdetail\StaffclassinfoResource;
use App\Http\Resources\Staff\Classinfo\Classmaster\StaffclassmasterinfoResource;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Staff\Interfacelayer\Classinfo\IStaffclassdetailApiRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;

class StaffclassdetailApiRepository implements IStaffclassdetailApiRepository
{
    public function classteacherclassmaster()
    {
        $assingsubject = Assignsubject::where('staff_id', auth()->user()->id)
            ->where('is_classteacher', true)
            ->get();
        if ($assingsubject->count() > 0) {
            return [true, StaffclassmasterinfoResource::collection($assingsubject), 'classteacherclassmaster'];
        } else {
            return [true, '', 'classteacherclassmaster'];
        }
    }

    public function staffclassmasterdetails()
    {
        $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
            ->first();

        $data['totalstudents'] = Student::where('classmaster_id', $classmastersection->classmaster_id)
            ->where('section_id', $classmastersection->section_id)
            ->where('active', true)
            ->count();

        $data['totalstaff'] = Staff::whereHas('assignsubject', fn($q) =>
            $q->where('classmaster_id', $classmastersection->classmaster_id)
                ->where('section_id', $classmastersection->section_id))
            ->count();

        $data['assingsubjectlistteacher'] = StaffclassinfoResource::collection(Assignsubject::where('classmaster_id', $classmastersection->classmaster_id)
                ->where('section_id', $classmastersection->section_id)
                ->whereNotNull('staff_id')
                ->get());

        return [true, $data, 'staffclassmasterdetails'];
    }

    public function staffclassmasterattendancedetails()
    {
        $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
            ->first();

        $today = Carbon::today();

        $assingsubjectlistteacher = Assignsubject::where('classmaster_id', $classmastersection->classmaster_id)
            ->where('section_id', $classmastersection->section_id)
            ->whereNotNull('staff_id')
            ->pluck('staff_id');

        $stafflist = Staff::whereHas('assignsubject', fn($q) =>
            $q->where('classmaster_id', $classmastersection->classmaster_id)
                ->where('section_id', $classmastersection->section_id))
            ->withCount(['staffattendancelist as present' => fn(Builder $q) =>
                $q->whereHas('staffattendance', fn($q) =>
                    $q->where('attendance_date', $today)
                        ->where('present', true),
                ),
            ])
            ->withCount(['staffattendancelist as absent' => fn(Builder $q) =>
                $q->whereHas('staffattendance', fn($q) =>
                    $q->where('attendance_date', $today)
                        ->where('absent', true),
                ),
            ])
            ->get();

        return [true, [
            'student' => new StaffclassstudentattendancedetailResource(
                Studentattendance::where('classmaster_id', $classmastersection->classmaster_id)
                    ->where('section_id', $classmastersection->section_id)
                    ->where('attendance_date', $today)
                    ->first()),
            'staff' => new StaffclassstaffattendancedetailResource($stafflist),
        ], 'getclassdetails'];
    }

    public function classteacherclassroutineinfo()
    {
        return [true,
            ClassroutineResource::collection(Classroutine::where('active', true)
                    ->with(['timetable' => fn($q) =>
                        $q->where('classmaster_section_id', ClassmasterSection::where('uuid', request('classmastersection_uuid'))
                                ->first()
                                ->id),
                        ])
                        ->get()),
                'classteacherclassroutineinfo'];
        }

        public function staffgetprogressbyclassectionuuid()
    {
            $subjectmark = [];
            $previoussubjectmark = [];
            $previouseachmark = 0;
            $progress = [];
            $rank = [];
            $attendance = [];
            $subject = [];
            $previousaverage = [];
            $eachrank = 0;
            $attendancepercentage = 0;
            $academicyear_id = App::make('generalsetting')->academicyear_id;
            $classmastersection = ClassmasterSection::where('uuid', request('classmastersection_uuid'))
                ->first();
            $totalstudents = Student::where('academicyear_id', $academicyear_id)
                ->where('classmaster_id', $classmastersection->classmaster_id)
                ->where('section_id', $classmastersection->section_id)
                ->where('active', true)
                ->get();
            $assignsubjectlist = Assignsubject::where('classmaster_id', $classmastersection->classmaster_id)
                ->where('section_id', $classmastersection->section_id)
                ->get();
            $exam = Exam::where('classmaster_id', $classmastersection->classmaster_id)
                ->whereJsonContains('section', (string) $classmastersection->section_id)
                ->where('is_main_exam', true)
                ->get()
                ->pluck('id');
            if ($exam) {
                foreach ($totalstudents as $key => $students) {
                    $examid = Examstudentlist::where('student_id', $students->id)
                        ->where('classmaster_id', $classmastersection->classmaster_id)
                        ->where('section_id', $classmastersection->section_id)
                        ->whereIn('exam_id', $exam)->pluck('id')->toArray();
                    $subjectmark[$key] = Examstudentsubjectlist::whereIn('examstudentlist_id', $examid)->get();
                    $attendance[$key] = round(($subjectmark[$key]->where('is_present', true)->count() / $subjectmark[$key]->count()) * 100);
                foreach ($assignsubjectlist as $key1 => $item1) {
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() != 0) {
                        $eachrank += round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') / $subjectmark[$key]->where('subject_id', $item1->subject_id)->count());
                        if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() > 1) {
                            $previousmark = $subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') - $subjectmark[$key]->where('subject_id', $item1->subject_id)->last()->first()->subjectmark_percentage;
                            $subjectcount = $subjectmark[$key]->where('subject_id', $item1->subject_id)->count() - 1;
                            $previouseachmark = round(($previousmark / $subjectcount));
                        }
                    }
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() != 0) {
                        $subject[$key][$item1->subject->name] = $eachrank == 0 ? "" : $eachrank;
                    } else {
                        $subject[$key][$item1->subject->name] = "";
                    }
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() > 1) {
                        $previoussubjectmark[$key][$item1->subject->name] = $previouseachmark == $eachrank ? 0 : (($eachrank > $previouseachmark) ? 1 : 2);
                    } else {
                        $previoussubjectmark[$key][$item1->subject->name] = "";
                    }
                }
                $rank[$key] = $eachrank;
                $previousaverage[$key] = $previouseachmark / $assignsubjectlist->count();
                $average[$key] = $eachrank / $assignsubjectlist->count();
                $eachrank = 0;
            }
            rsort($rank);
            if (sizeof($rank) == 0) {
                $rank = [];
            }
            foreach ($totalstudents as $key => $students) {
                $progress[$key]['name'] = $students->name;
                $eachrank = 0;
                foreach ($assignsubjectlist as $item1) {
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() != 0) {
                        $eachrank += round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') / $subjectmark[$key]->where('subject_id', $item1->subject_id)->count());
                    }
                }
                foreach ($assignsubjectlist as $item1) {
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() > 1) {
                        $eachrank += round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') / $subjectmark[$key]->where('subject_id', $item1->subject_id)->count());
                    }
                }
                if (array_sum($rank) == 0) {
                    $progress[$key]['rank'] = '';

                } else {
                    $progress[$key]['rank'] = array_search($eachrank, $rank) + 1;
                }
                if (array_sum($attendance) != 0) {
                    $progress[$key]['attendance'] = $attendance[$key] . ' %';
                }
                if (array_sum($average) == 0) {
                    $progress[$key]['average'] = "";
                } else {
                    $progress[$key]['average'] = $average[$key];
                }
                if (array_sum($previousaverage) == 0) {
                    $progress[$key]['previousaverage'] = "";
                } else {
                    $progress[$key]['previousaverage'] = $previousaverage[$key] > $average[$key] ? 1 : 0;
                }
                $progress[$key]['subjectmark'] = $subject[$key];
                if (!empty($previoussubjectmark)) {
                    $progress[$key]['previoussubjectmark'] = $previoussubjectmark[$key];
                } else {
                    $progress[$key]['previoussubjectmark'] = "";
                }

            }
        }
        return [true, $progress, 'getprogressbyclassectionuuid'];
    }
}
