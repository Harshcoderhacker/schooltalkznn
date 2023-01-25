<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboardlivewire extends Component
{
    public $totalstudents, $studentpresentcount, $todaystudentsattendancepercentage;

    public $totalstaffs, $staffpresentcount, $todaystaffsattendancepercentage, $staffcount, $staffabsentcount;

    public $feedue, $exam, $staffleaverequest;

    public $attendance_date;

    public function mount()
    {
        $this->attendance_date = Carbon::today()->format('Y-m-d');
        $this->staffcount = Staff::where('active', true)->count();
        $this->totalstudents = Student::where('active', true)->where('is_accountactive', true)->count();
    }

    public function studentattendance()
    {

        $studentattendance = Studentattendance::where('attendance_date', $this->attendance_date)
            ->where('attendance_status', true)
            ->where('is_holiday', false)
            ->get();

        foreach ($studentattendance as $value) {
            $this->studentpresentcount += count($value->presentstudent);
        }

        if ($this->studentpresentcount == 0) {
            $this->todaystudentsattendancepercentage = 0;
        } else {
            $this->todaystudentsattendancepercentage = round(($this->studentpresentcount / $this->totalstudents) * 100);
        }
    }
    public function staffattendance()
    {
        $staffattendance = Staffattendance::where('attendance_date', $this->attendance_date)
            ->where('attendance_status', true)
            ->where('is_holiday', false)
            ->get();

        foreach ($staffattendance as $value) {
            $this->staffpresentcount += count($value->presentstaff);
            $this->staffabsentcount += count($value->absentstaff);
        }

        if ($this->staffpresentcount == 0) {
            $this->todaystaffsattendancepercentage = 0;
        } else {
            $this->todaystaffsattendancepercentage = round(($this->staffpresentcount / $this->staffcount) * 100);
        }
    }

    public function feesdue()
    {
        $feeassignstudent = Feeassignstudent::where('is_selected', true)->get();
        $this->feedue = round($feeassignstudent->sum('due_amount'), 2);
    }

    public function todayexam()
    {
        $exam = Examsubject::where('examdate', today())->get();
        $this->exam = $exam->unique('exam_id');
    }
    public function staffleaveapplications()
    {
        $this->staffleaverequest = Staffleaverequest::where('active', true)
            ->whereNull('is_approved')
            ->latest()
            ->get();
    }
    public function convert()
    {
        try {
            DB::beginTransaction();
            $feed = Feedpost::where('is_mediatype', 1)->get();
            foreach ($feed as $key => $value) {
                $images[$key]['images'] = $value->image;
                $value->update(['image' => json_encode($images)]);
            }
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Converted Successfully!']);
        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }
    public function render()
    {
        $this->studentattendance();
        $this->staffattendance();
        $this->feesdue();
        $this->todayexam();
        $this->staffleaveapplications();
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
        return view('livewire.admin.dashboard.dashboardlivewire', compact('dueclasses', 'greetings'));
    }
    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_classmaster_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
