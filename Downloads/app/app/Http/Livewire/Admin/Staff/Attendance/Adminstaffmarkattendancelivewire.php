<?php

namespace App\Http\Livewire\Admin\Staff\Attendance;

use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Attendance\Staffattendancelist;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Adminstaffmarkattendancelivewire extends Component
{
    public $staffattendance;
    public $note;

    public function mount(Staffattendance $staffattendanceid)
    {
        $this->staffattendance = $staffattendanceid;
        $this->user = auth()->user();
        foreach ($staffattendanceid->staffattendancelist as $eachstaffattendancelist) {
            $this->note[$eachstaffattendancelist->id] = $eachstaffattendancelist->note;
        }
    }

    public function markthistaffattendance(Staffattendancelist $staffattendancelist, $field)
    {
        try {
            DB::beginTransaction();

            $staffattendancelist->present = ($field == 'present') ? true : false;
            $staffattendancelist->late = ($field == 'late') ? true : false;
            $staffattendancelist->absent = ($field == 'absent') ? true : false;
            $staffattendancelist->halfday = ($field == 'halfday') ? true : false;
            $staffattendancelist->save();
            $this->markedby();

            $totalpresent = $staffattendancelist->staffattendance->presentstaff->count();
            $totalstaff = $staffattendancelist->staffattendance->staffattendancelist->count();
            $percent = $totalpresent / $totalstaff * 100;
            $staffattendancelist->staffattendance->attendance_percentage = $percent;
            $staffattendancelist->staffattendance->save();

            Helper::trackmessage($this->user, 'Admin Mark Attendance', 'admin_web_mark_staff_attendance', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('makestaffattendance', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('makestaffattendance', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('makestaffattendance', 'three', $e);
        }
    }

    public function updatedNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->note as $key => $value) {
                Staffattendancelist::find($key)->update([
                    'note' => $value,
                ]);
            }
            $this->markedby();
            Helper::trackmessage($this->user, 'Admin Mark Attendance Note', 'admin_web_mark_staff_attendance_note', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('makestaffattendancenote', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('makestaffattendancenote', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('makestaffattendancenote', 'three', $e);
        }

    }

    protected function markedby()
    {
        $staffattendance = Staffattendance::find($this->staffattendance->id);
        if (!$staffattendance->marked_id) {
            $staffattendance->marked_id = $this->user->id;
            $staffattendance->usertype = $this->user->usertype;
            $staffattendance->attendance_status = true;
            $staffattendance->save();
        }
    }

    public function render()
    {
        return view('livewire.admin.staff.attendance.adminstaffmarkattendancelivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
