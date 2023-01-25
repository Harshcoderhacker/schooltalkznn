<?php

namespace App\Http\Livewire\Admin\Exam\Exammark;

use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Exammarkentrylivewire extends Component
{
    public $exam_id, $user, $examsubject, $examstudentlist_id, $subject_id, $remarks, $marklist = [];

    public $classmasterid, $sectionid, $classmaster;
    public $section = [];
    public function mount($examid, $subjectid)
    {
        $this->exam_id = $examid;
        $this->subject_id = $subjectid;
        $this->user = auth()->user();
        $this->classmaster = Classmaster::where('active', true)->get();

    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid && is_numeric($this->classmasterid)) {
            $this->section = Classmaster::find($this->classmasterid)->section;

        } else {
            $this->section = [];
        }
    }

    public function updatedRemarks()
    {
        try {
            DB::beginTransaction();

            foreach ($this->remarks as $key => $value) {
                if ($value == '') {
                    $value = null;
                }
                Examstudentsubjectlist::find($key)->update([
                    'remarks' => $value,
                ]);
            }
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

    public function render()
    {
        $studentlist = Examstudentsubjectlist::with('examstudentlist.student')->where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)
            ->whereHas('examstudentlist.student', function (Builder $query) {
                ($this->classmasterid) ? $query->where('classmaster_id', $this->classmasterid) : '';
                ($this->sectionid) ? $query->where('section_id', $this->sectionid) : '';
            })
            ->get();
        $this->examsubject = Examsubject::where('exam_id', $this->exam_id)
            ->where('subject_id', $this->subject_id)
            ->first();

        foreach ($studentlist as $eachstudentlist) {
            $this->remarks[$eachstudentlist->id] = $eachstudentlist->remarks;
        }

        return view('livewire.admin.exam.exammark.exammarkentrylivewire', compact('studentlist'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
