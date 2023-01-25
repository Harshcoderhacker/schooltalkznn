<?php

namespace App\Http\Livewire\Admin\Exam\Examattendance;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Markexamattendancelivewire extends Component
{
    public $exam_id, $user, $examstudentlist_id, $subject_id, $note;

    public function mount($examid, $subjectid)
    {
        $this->exam_id = $examid;
        $this->subject_id = $subjectid;
        $this->user = auth()->user();
    }

    public function markthistudentattendance(Examstudentsubjectlist $examstudentattendancelist, $field)
    {
        try {
            DB::beginTransaction();
            if ($field == 0) {
                $examstudentattendancelist->is_present = $field;
                $examstudentattendancelist->mark = $field;
                $examstudentattendancelist->subjectmark_percentage = $field;
                $examstudentattendancelist->is_pass = $field;
                $examstudentattendancelist->save();
            } else {
                $examstudentattendancelist->is_present = $field;
                $examstudentattendancelist->mark = null;
                $examstudentattendancelist->subjectmark_percentage = null;
                $examstudentattendancelist->is_pass = null;
                $examstudentattendancelist->save();
            }

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

            Helper::trackmessage($this->user, 'Admin Mark Exam Attendance', 'admin_web_mark_student_exam_attendance', session()->getId(), 'WEB');

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
            Helper::trackmessage($this->user, 'Admin Mark Exam Attendance Note', 'admin_web_mark_student_exam_attendance_note', session()->getId(), 'WEB');

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
        $studentlist = Examstudentsubjectlist::where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)->get();
        foreach ($studentlist as $eachstudentlist) {
            $this->note[$eachstudentlist->id] = $eachstudentlist->note;
        }
        return view('livewire.admin.exam.examattendance.markexamattendancelivewire', compact('studentlist'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
