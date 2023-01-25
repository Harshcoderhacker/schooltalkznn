<?php

namespace App\Http\Livewire\Aparent\Attendance;

use App\Models\Admin\Settings\Schoolsetting\Academicyearmonthlist;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use App\Models\Admin\Student\Leave\Studentleaverequest;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Parentattendanceindexlivewire extends Component
{
    use WithPagination;

    public $user, $student;
    public $applyleavemodel = false;
    public $from_date, $reason, $to_date;
    public $appliedleavemodel = false;
    public $academicyear_id;
    public $month_string;

    public function mount()
    {
        $this->user = auth()->guard('aparent')->user();
        $this->month_string = Carbon::now()->format('F Y');
        $this->student = Parenthelper::getstudentweb();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;

        $this->academicyearmonthlist = Academicyearmonthlist::whereDate('monthdate', '<=', Carbon::now())
            ->whereHas('academicyear', fn(Builder $q) => $q->where('id', $this->academicyear_id))
            ->get();
    }

    public function formreset()
    {
        $this->from_date = null;
        $this->to_date = null;
        $this->reason = null;
        $this->resetErrorBag();
    }

    public function closeapplyleavemodel()
    {
        $this->applyleavemodel = false;
        $this->resetErrorBag();
    }

    public function openapplyleavemodel()
    {
        $this->applyleavemodel = true;
    }

    public function closeappliedleavemodel()
    {
        $this->appliedleavemodel = false;
    }

    public function openappliedleavemodel()
    {
        $this->appliedleavemodel = true;
    }

    public function downloadattendacereport(Academicyearmonthlist $monthlist)
    {
        $student = $this->student;
        $studentattendance = Studentattendancelist::where('student_id', $student->id)
            ->whereHas('studentattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        $pdf = Pdf::loadView('admin.student.attendance.pdf.studentattendancereportpdf',
            compact('student', 'monthlist', 'studentattendance'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Attendance Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Studentattendancereport.pdf');
    }

    public function applyleave()
    {
        $this->validate([
            'from_date' => 'required|date|after_or_equal:' . Carbon::today(),
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required',
        ], [
            'from_date.after_or_equal' => 'Invalid Date',
            'to_date.after_or_equal' => 'Invalid Date',
        ]);

        try {
            DB::beginTransaction();

            Studentleaverequest::create([
                'classmaster_id' => $this->student->classmaster_id,
                'section_id' => $this->student->section_id,

                'aparent_id' => $this->user->id,
                'student_id' => $this->student->id,

                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'reason' => $this->reason,
            ]);
            Helper::trackmessage($this->student, 'Student Apply Leave', 'student_web_apply_leave', session()->getId(), 'WEB');

            DB::commit();
            $this->formreset();
            $this->closeapplyleavemodel();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Leave Appplied!']);

        } catch (Exception $e) {
            $this->exceptionerror('student_applyleave', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('student_applyleave', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('student_applyleave', 'three', $e);
        }
    }

    public function render()
    {
        $appliedleaves = Studentleaverequest::where('student_id', $this->student->id)
            ->latest()
            ->paginate(5)->onEachSide(1);
        return view('livewire.aparent.attendance.parentattendanceindexlivewire', compact('appliedleaves'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': student_web_applyleave' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
