<?php

namespace App\Http\Livewire\Staff\Exam\Examattendance;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Staffmarkexamattendancelivewire extends Component
{
    public $exam_id, $user, $examstudentlist_id, $subject_id, $note;
    public $classmaster_id, $section_id;

    public function mount($examid, $subjectid, $classmasterid, $sectionid)
    {
        $this->exam_id = $examid;
        $this->subject_id = $subjectid;
        $this->classmaster_id = $classmasterid;
        $this->section_id = $sectionid;
        $this->user = auth()->guard('staff')->user();
    }

    public function markthistudentattendance(Examstudentsubjectlist $examstudentattendancelist, $field)
    {
        try {
            DB::beginTransaction();

            $examstudentattendancelist->is_present = $field;
            $examstudentattendancelist->save();

            $this->markedby();

            $totalpresent = $examstudentattendancelist->where('is_present', true)
                ->where('exam_id', $this->exam_id)
                ->where('subject_id', $this->subject_id)->count();
            $totalstudent = $examstudentattendancelist->where('exam_id', $this->exam_id)
                ->where('subject_id', $this->subject_id)
                ->count();
            $percent = ($totalpresent / $totalstudent) * 100;

            Examsubject::where('exam_id', $this->exam_id)
                ->where('subject_id', $this->subject_id)
                ->update(['attendance_percentage' => $percent]);

            Helper::trackmessage($this->user, 'Staff Mark Exam Attendance', 'staff_web_mark_student_exam_attendance', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('marktudentattendance', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('marktudentattendance', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('marktudentattendance', 'three', $e);
        }
    }

    public function updatedNote()
    {
        try {
            DB::beginTransaction();

            foreach ($this->note as $key => $value) {
                Examstudentsubjectlist::find($key)->update([
                    'note' => $value,
                ]);
            }
            $this->markedby();
            Helper::trackmessage($this->user, 'Staff Mark Exam Attendance Note', 'staff_web_mark_student_exam_attendance_note', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('makestudentattendancenote', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('makestudentattendancenote', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('makestudentattendancenote', 'three', $e);
        }

    }

    protected function markedby()
    {
        Exam::where('id', $this->exam_id)->update(['is_lock' => 1]);
        $examstudentattendancelist = Examsubject::where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)->first();
        if (!$examstudentattendancelist->attendance_marked_id) {
            $examstudentattendancelist->attendance_updated_at = Carbon::today();
            $examstudentattendancelist->attendance_marked_id = $this->user->id;
            $examstudentattendancelist->attendance_usertype = $this->user->usertype;
            $examstudentattendancelist->attendance_status = true;
            $examstudentattendancelist->save();
        } else {
            $examstudentattendancelist->update(['attendance_marked_id' => $this->user->id, 'attendance_usertype' => $this->user->usertype, 'attendance_updated_at' => Carbon::today()]);
        }
    }

    public function render()
    {
        $studentlist = Examstudentsubjectlist::with('examstudentlist.student')->where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)
            ->whereHas('examstudentlist.student', function (Builder $query) {
                $query->where('classmaster_id', $this->classmaster_id);
                $query->where('section_id', $this->section_id);
            })
            ->get();
        foreach ($studentlist as $eachstudentlist) {
            $this->note[$eachstudentlist->id] = $eachstudentlist->note;
        }
        return view('livewire.staff.exam.examattendance.staffmarkexamattendancelivewire', compact('studentlist'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
