<?php

namespace App\Http\Livewire\Staff\Smartattendance;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Attendance\Staffsmartattendance;
use App\Models\Admin\Staff\Leave\Staffleaverequest;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Smartattendanceindexlivewire extends Component
{
    public $showmodal = false;
    public $showavailableteachers = false;
    public $date, $staff;
    public $classroutine;
    public $availableteachers;
    public $availabletime;
    public $dateinput = false, $selecteddate, $stafflist;

    public function mount($date)
    {
        if ($date) {
            $this->date = Carbon::today();
            Log::info($this->date);
            $this->active = "today";
        } else {
            $this->date = null;
            $this->dateinput = true;
            $this->active = "upcoming";
        }
    }

    public function closemodal()
    {
        $this->staff = null;
        $this->classroutine = null;
        $this->showmodal = false;
    }

    public function openmodal()
    {
        $this->showmodal = true;
    }

    public function selecthisdate()
    {
        $this->validate([
            'selecteddate' => 'required|date|after:' . Carbon::now(),
        ], [
            'selecteddate.required' => 'Date is Required',
            'selecteddate.date' => 'Invalid format',
            'selecteddate.after' => 'Invalid Date',
        ]);
        $this->date = Carbon::parse($this->selecteddate);

        $this->stafflist = Staffleaverequest::whereDate('from_date', '<=', $this->date)
            ->whereDate('to_date', '>=', $this->date)
            ->where('is_approved', true)
            ->get();
    }

    public function openavailableteachers(Classroutine $classroutine, $day)
    {
        $mainquery = Stafftimetable::where('classroutine_id', $classroutine->id)
            ->whereNull($day);
        if (!$this->dateinput) {
            $mainquery->whereHas('staff', function ($query) {
                $query->where('active', true)
                    ->whereHas('staffattendancelist', function ($query) {
                        $query->whereHas('staffattendance', fn($q) =>
                            $q->where('attendance_date', $this->date)
                                ->where('present', true),
                        );
                    });
            });
        }
        $this->availableteachers = $mainquery->get();

        $this->availabletime = $classroutine->start_time->format('g:ia');

        if ($this->availableteachers->count() == 0) {
            $this->dispatchBrowserEvent('warningtoast', ['message' => 'Staff Not Available']);
        } else {
            $this->classroutine = Classroutine::where('active', true)
                ->with(['stafftimetable' => fn($q) =>
                    $q->where('staff_id', $this->staff->id),
                ])
                ->get();
            $this->showavailableteachers = true;
        }
    }

    public function closeavailableteachers()
    {
        $this->showavailableteachers = false;
        $this->classroutine = Classroutine::where('active', true)
            ->with(['stafftimetable' => fn($q) =>
                $q->where('staff_id', $this->staff->id),
            ])
            ->get();
    }

    public function showmodal(Staff $staff)
    {
        $this->staff = $staff;
        $this->classroutine = Classroutine::where('active', true)
            ->with(['stafftimetable' => fn($q) =>
                $q->where('staff_id', $staff->id),
            ])
            ->get();
        $this->showmodal = true;
    }

    public function selectteacher($assingedstaff_id, $classroutineid)
    {
        try {
            DB::beginTransaction();

            $smartattendance = Staffsmartattendance::updateOrCreate([
                'staff_id' => $this->staff->id,
                'actual_date' => $this->date,
                'day' => strtolower($this->date->format('l')),
                'classroutine_id' => $classroutineid,
            ], [
                'assingedstaff_id' => $assingedstaff_id,
                'user_id' => auth()->user()->id,
                'initiated_date' => $this->dateinput ? Carbon::today() : null,
            ]);
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Assinged Successfully!']);
            $this->closeavailableteachers();
        } catch (Exception $e) {
            $this->exceptionerror('assingteachersmartattendance', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('assingteachersmartattendance', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('assingteachersmartattendance', 'three', $e);
        }
    }

    public function render()
    {
        $staffattendance = Staffattendance::where('attendance_date', $this->date)
            ->first();

        return view('livewire.staff.smartattendance.smartattendanceindexlivewire', compact('staffattendance'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_smart_attendance_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
