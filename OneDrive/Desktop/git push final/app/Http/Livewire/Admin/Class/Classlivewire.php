<?php

namespace App\Http\Livewire\Admin\Class;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Classlivewire extends Component
{
    public $exam, $examschedulemodal = false, $examschedule, $classmaster, $sectionname;
    public $classmasterid, $sectionid, $academicyear_id;
    public $classmasterlist, $section, $attendancedate, $tab = 'attendance';
    public $viewabsentees;
    public $classroutine, $assignsubjectlist;
    public function mount()
    {
        $this->classmasterlist = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid && is_numeric($this->classmasterid)) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
            $this->attendancedate = '';
        }
    }

    public function changetab($tab)
    {
        $this->tab = $tab;
    }

    public function viewabsentees($who)
    {
        if ($this->viewabsentees == '') {
            $this->viewabsentees = $who;
        } else {
            $this->viewabsentees = '';
        }

    }

    public function viewschedule($examid)
    {
        $this->examschedulemodal = true;
        $this->examschedule = Examsubject::where('exam_id', $examid)->get();
    }

    public function closeviewschedule()
    {
        $this->examschedulemodal = false;
        $this->examschedule = [];
    }

    public function render()
    {
        $day = strtolower(Carbon::parse($this->attendancedate)->format('l'));
        $subjectmark = [];
        $rank = [];
        $eachrank = 0;
        $totalstudents = Student::where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->where('active', true)
            ->get();

        $studentattendace = Studentattendance::with('studentattendancelist')
            ->where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->where('attendance_date', $this->attendancedate)
            ->first();

        $staffattendance = Staff::whereHas('assignsubject', fn($q) =>
            $q->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid))
            ->withCount(['staffattendancelist as present' => fn(Builder $q) =>
                $q->whereHas('staffattendance', fn($q) =>
                    $q->where('attendance_date', $this->attendancedate)
                        ->where('present', true),
                ),
            ])
            ->withCount(['staffattendancelist as absent' => fn(Builder $q) =>
                $q->whereHas('staffattendance', fn($q) =>
                    $q->where('attendance_date', $this->attendancedate)
                        ->where('absent', true),
                ),
            ])
            ->get();

        $stafflist = $staffattendance->where('absent', true);

        if ($this->sectionid) {
            $classmastersectionid = ClassmasterSection::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)->first();

            $this->classroutine = Classroutine::where('active', true)
                ->with(['timetable' => fn($q) =>
                    $q->where('classmaster_section_id', $classmastersectionid->id),
                ])
                ->get();
            $this->exam = Exam::where('classmaster_id', $this->classmasterid)->whereJsonContains('section', $this->sectionid)->get();
            $this->classmaster = Classmaster::find($this->classmasterid)->name;
            $this->sectionname = Section::find($this->sectionid)->name;
            $this->assignsubjectlist = Assignsubject::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();
            $exam = Exam::where('classmaster_id', $this->classmasterid)
                ->whereJsonContains('section', $this->sectionid)
                ->where('is_main_exam', true)
                ->pluck('id');
            foreach ($totalstudents as $key => $students) {
                $examid = Examstudentlist::where('student_id', $students->id)
                    ->where('classmaster_id', $this->classmasterid)
                    ->where('section_id', $this->sectionid)
                    ->whereIn('exam_id', $exam)->pluck('id')->toArray();
                $subjectmark[$key] = Examstudentsubjectlist::whereIn('examstudentlist_id', $examid)->get();
                foreach ($this->assignsubjectlist as $item1) {
                    if ($subjectmark[$key]->where('subject_id', $item1->subject_id)->count() != 0) {
                        $eachrank += round($subjectmark[$key]->where('subject_id', $item1->subject_id)->sum('subjectmark_percentage') / $subjectmark[$key]->where('subject_id', $item1->subject_id)->count());
                    }
                }
                $rank[$key] = $eachrank;
                $eachrank = 0;
            }
        }
        rsort($rank);
        if (sizeof($rank) == 0) {
            $rank = [];
        }

        return view('livewire.admin.class.classlivewire', compact('studentattendace', 'stafflist', 'rank', 'totalstudents', 'subjectmark', 'staffattendance', 'day'));
    }
}
