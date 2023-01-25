<?php

namespace App\Http\Livewire\Aparent\Dashboard;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Models\Parent\Settings\Mobile\Parentappactivestudent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Dashboardlivewire extends Component
{
    public $currentstudent, $user, $currentuser, $material, $academicyear_id, $gamificationstar, $exam;
    public $feedue, $day, $studenttodaytimetable, $assignsubject, $assessment, $homeworklist, $rank, $examsubjectmark;
    public $viewmarkmodel = false;

    protected $rules = [
        'currentstudent' => 'required',
    ];

    public function mount()
    {
        $this->user = auth()->guard('aparent')->user();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->currentstudent = Parentappactivestudent::where('parenttokenid', session()->getId() . $this->user->uuid)
            ->first()->student_uuid;
    }

    public function sutdentswap()
    {
        try {
            DB::beginTransaction();
            $student = Student::where('active', true)->where('uuid', $this->currentstudent)->first();

            $this->currentstudent = Parentappactivestudent::updateOrCreate(['parenttokenid' => session()->getId() . $this->user->uuid], [
                'student_id' => $student->id,
                'student_uuid' => $student->uuid,
                'aparent_id' => $this->user->id,
                'type' => 'web',
                'parenttokenid' => session()->getId() . $this->user->uuid,
            ])->student_uuid;

            Helper::trackmessage($this->user, 'Parent Swap Student ', 'parent_web_parentswapstudent',
                session()->getId(),
                'WEB');
            $this->dispatchBrowserEvent('updatetoast', ['message' => 'Student Swapped']);
            DB::commit();
            return redirect()->to('/parent/parentdashboard');
        } catch (Exception $e) {
            $this->exceptionerror('parent_web_studentswap', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('parent_web_studentswap', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('parent_web_studentswap', 'three', $e);
        }
    }

    public function materials()
    {
        $this->material = Materiallist::where('active', true)->where('created_at', Carbon::today())->get();
    }

    public function schooltaklzstar()
    {
        $this->gamificationstar = $this->currentuser->withSum('gamificationable', 'star')->where('id', $this->currentuser->id)->first();
    }

    public function feesdue()
    {
        $this->feedue = Feeassignstudent::where('student_id', $this->currentuser->id)
            ->where('is_selected', true)->sum('due_amount');
    }

    public function assessment()
    {
        $onlineassessmentid = Onlineassessment::where(function ($query) {
            $query->where('assigntype', 1)
                ->orWhere(function ($query1) {
                    $query1->where('assigntype', 2)->where('end_date', '>=', Carbon::today());
                }
                );
        })
            ->pluck('id');
        $this->assessment = Onlineassessmentstudentlist::where('student_id', $this->currentuser->id)->whereIn('onlineassessment_id', $onlineassessmentid)->get();
    }
    public function homework()
    {
        $homeworkid = Homework::where('classmaster_id', $this->currentuser->classmaster_id)
            ->where('section_id', $this->currentuser->section_id)
            ->pluck('id');
        $this->homeworklist = Homeworklist::where('student_id', $this->currentuser->id)->whereIn('homework_id', $homeworkid)->get();
    }
    public function examrank()
    {
        $total_mark = [];
        $index = 0;
        $this->exam = Exam::where('is_main_exam', true)->latest()->first();
        if ($this->exam) {
            $studentlist = Student::where('classmaster_id', $this->currentuser->classmaster_id)->where('section_id', $this->currentuser->section_id)
                ->pluck('id');
            $this->examsubjectmark = Examstudentsubjectlist::where('exam_id', $this->exam->id)->whereHas('examstudentlist',
                fn(Builder $q) => $q->where('student_id', $this->currentuser->id)->where('classmaster_id', $this->currentuser->classmaster_id)
                    ->where('section_id', $this->currentuser->section_id))->get();
            foreach ($studentlist as $key => $eachstudent) {
                $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->exam->id)->where('student_id', $eachstudent)
                    ->where('classmaster_id', $this->currentuser->classmaster_id)
                    ->where('section_id', $this->currentuser->section_id)->get();
                if ($examstudentlist->isNotEmpty()) {
                    if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                        $total_mark[$index] = $examstudentlist[0]->examstudentsubjectlist->sum('mark');
                        $index += 1;
                    }
                }
            }
            rsort($total_mark);
            if (sizeof($total_mark) > 0 && $this->examsubjectmark) {
                if (sizeof($this->examsubjectmark->where('exam_id', $this->exam->id)) == $this->examsubjectmark->where('exam_id', $this->exam->id)->where('is_pass')->count()) {
                    $studentmark = $this->examsubjectmark->sum('mark');
                    $this->rank = array_search($studentmark, $total_mark) + 1;
                } else {
                    $this->rank = 0;
                }
            }
        } else {
            $this->rank = 0;
        }

    }
    public function openviewmark()
    {
        $this->viewmarkmodel = true;
    }
    public function closeviewmark()
    {
        $this->viewmarkmodel = false;
    }

    public function todayroutine()
    {
        $this->day = Carbon::now()->format('l');
        $classmastersectionid = ClassmasterSection::where('classmaster_id', $this->currentuser->classmaster_id)
            ->where('section_id', $this->currentuser->section_id)
            ->first()
            ->id;
        $this->studenttodaytimetable = Timetable::where('classmaster_section_id', $classmastersectionid)
            ->whereNotNull($this->day)
            ->get()->sortBy('classroutine_id');
        $this->assignsubject = Assignsubject::where('active', true)->get();
    }
    public function render()
    {
        $students = Student::where('active', true)
            ->where('aparent_id', $this->user->id)
            ->select('name', 'uuid')
            ->get();
        $this->currentuser = Parenthelper::getstudentweb();
        $this->assessment();
        $this->schooltaklzstar();
        $this->materials();
        $this->feesdue();
        $this->todayroutine();
        $this->homework();
        $this->examrank();
        $greetings = "";
        $time = date("H");
        $timezone = date("e");
        if ($time < "12") {
            $greetings = "Good morning";
        } else
        if ($time >= "12" && $time < "17") {
            $greetings = "Good afternoon";
        } else
        if ($time >= "17" && $time < "19") {
            $greetings = "Good evening";
        } else
        if ($time >= "19") {
            $greetings = "Good night";
        }
        return view('livewire.aparent.dashboard.dashboardlivewire', compact('students', 'greetings'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': parent_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
