<?php

namespace App\Http\Livewire\Staff\Attendance;

use App\Models\Admin\Settings\Leavesetting\Leavetype;
use App\Models\Admin\Settings\Schoolsetting\Academicyearmonthlist;
use App\Models\Admin\Staff\Attendance\Staffattendancelist;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Miscellaneous\Helper;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Staffattendanceindexlivewire extends Component
{
    use WithPagination;

    public $user;
    public $applyleavemodel = false;
    public $from_date, $reason, $to_date;
    public $leavetype_id;
    public $leavetype;
    public $appliedleavemodel = false;
    public $staffattendance;
    public $academicyear_id, $academicyearmonthlist;
    public $month_string;

    public function mount()
    {
        $this->user = auth()->guard('staff')->user();
        $this->month_string = Carbon::now()->format('F Y');
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;

        $this->academicyearmonthlist = Academicyearmonthlist::whereDate('monthdate', '<=', Carbon::now())
            ->whereHas('academicyear', fn(Builder $q) => $q->where('id', $this->academicyear_id))
            ->get();

        $this->leavetype = Leavetype::where('active', true)->get();
    }

    public function formreset()
    {
        $this->from_date = null;
        $this->to_date = null;
        $this->reason = null;
        $this->leavetype_id = null;
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
        $staff = $this->user;
        $staffattendance = Staffattendancelist::where('staff_id', $staff->id)
            ->whereHas('staffattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        $pdf = Pdf::loadView('admin.staff.attendance.pdf.staffattendancereportpdf',
            compact('staff', 'monthlist', 'staffattendance'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Attendance Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Staffattendancereport.pdf');
    }

    public function applyleave()
    {
        $this->validate([
            'from_date' => 'required|date|after_or_equal:' . Carbon::today(),
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'required|min:1|max:250',
            'leavetype_id' => 'required|integer',
        ], [
            'from_date.after_or_equal' => 'Invalid Date',
            'to_date.after_or_equal' => 'Invalid Date',
            'leavetype_id.required' => 'Select Leave Type',
            'leavetype_id.integer' => 'Select Leave Type',
        ]);

        try {
            DB::beginTransaction();

            Staffleaverequest::create([
                'staff_id' => $this->user->id,
                'leavetype_id' => $this->leavetype_id,
                'from_date' => $this->from_date,
                'to_date' => $this->to_date,
                'reason' => $this->reason,
            ]);
            Helper::trackmessage($this->user, 'staff Apply Leave', 'staff_web_apply_leave', session()->getId(), 'WEB');

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
        $appliedleaves = Staffleaverequest::where('staff_id', $this->user->id)
            ->latest()
            ->paginate(5)
            ->onEachSide(1);
        return view('livewire.staff.attendance.staffattendanceindexlivewire', compact('appliedleaves'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': student_web_applyleave' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
