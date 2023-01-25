<?php

namespace App\Http\Livewire\Staff\Dashboard;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Staff\Payroll\Payroll;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Staffdashboardlivewire extends Component
{
    public $attendance_date, $user, $homeworklist, $academicyear_id, $payroll, $assessment, $gamificationstar, $stafftodaytimetable, $day, $assignsubject;

    public function mount()
    {
        $this->user = auth()->guard('staff')->user();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function homework()
    {
        $homeworkid = Homework::whereHas('assignsubject',
            fn(Builder $q) => $q->where('staff_id', $this->user->id))
            ->pluck('id');
        $this->homeworklist = Homeworklist::whereIn('homework_id', $homeworkid)->get();
    }
    public function staffpayslip()
    {
        $this->payroll = Payroll::latest()->first();
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
        $this->assessment = Onlineassessmentstudentlist::whereIn('onlineassessment_id', $onlineassessmentid)->get();
    }
    public function schooltaklzstar()
    {
        $this->gamificationstar = $this->user
            ->withSum('gamificationable', 'star')
            ->where('id', $this->user->id)
            ->first();
    }
    public function todayroutine()
    {
        $this->day = Carbon::now()->format('l');
        $this->stafftodaytimetable = Stafftimetable::where('staff_id', $this->user->id)->whereNotNull($this->day)->get()->sortBy('classroutine_id');
        $this->assignsubject = Assignsubject::where('staff_id', $this->user->id)->get();
    }

    public function render()
    {
        $this->homework();
        $this->staffpayslip();
        $this->assessment();
        $this->todayroutine();
        $this->schooltaklzstar();
        $dueclasses = Lesson::where('is_completed', false)->count();
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
        return view('livewire.staff.dashboard.staffdashboardlivewire', compact('greetings', 'dueclasses'));
    }
}
