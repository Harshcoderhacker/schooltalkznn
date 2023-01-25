<?php

namespace App\Http\Livewire\Admin\Exam\Exammark;

use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Exammarkvalueentrylivewire extends Component
{
    public $examstudentsubjectlist, $examsubject, $mark;
    public function mount(Examstudentsubjectlist $examstudentsubjectlist, $subject_id)
    {
        $this->examstudentsubjectlist = $examstudentsubjectlist;
        $this->mark = $this->examstudentsubjectlist->mark;
        $this->examsubject = Examsubject::where('exam_id', $this->examstudentsubjectlist->exam_id)
            ->where('subject_id', $subject_id)
            ->first();
    }

    public function updatedMark()
    {

        $this->validate(
            ['mark' => 'required|lte:' . $this->examsubject->mark],
            [
                'mark.lte' => 'Mark should not greater than' . $this->examsubject->mark,
            ]
        );
        try {
            DB::beginTransaction();
            $passpercentage = Exampasspercentage::where('active', true)->first();
            $subjectmark_percentage = round(($this->mark / $this->examsubject->mark) * 100);
            if ($subjectmark_percentage >= $passpercentage->pass_percentage) {
                $this->examstudentsubjectlist->update(['mark' => $this->mark, 'is_pass' => 1, 'subjectmark_percentage' => $subjectmark_percentage]);
            } else {
                $this->examstudentsubjectlist->update(['mark' => $this->mark, 'is_pass' => 0, 'subjectmark_percentage' => $subjectmark_percentage]);
            }

            if (!$this->examsubject->mark_marked_id) {
                $this->examsubject->mark_updated_at = Carbon::today();
                $this->examsubject->mark_marked_id = auth()->user()->id;
                $this->examsubject->mark_usertype = auth()->user()->usertype;
                $this->examsubject->mark_status = true;
                $this->examsubject->save();
            } else {
                $this->examsubject->update(['mark_marked_id' => auth()->user()->id, 'mark_usertype' => auth()->user()->usertype, 'mark_updated_at' => Carbon::today()]);
            }

            Helper::trackmessage(auth()->user(), 'Admin Mark Exam mark', 'admin_web_mark_student_exam_mark', session()->getId(), 'WEB');

            DB::commit();
        } catch (Exception $e) {
            $this->exceptionerror('marktudentmark', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('marktudentmark', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('marktudentmark', 'three', $e);
        }
    }

    public function render()
    {
        return view('livewire.admin.exam.exammark.exammarkvalueentrylivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
