<?php

namespace App\Http\Livewire\Staff\Exam\Createexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Staffexamcreateviewindexlivewire extends Component
{
    public $today;
    public $paginationlength = 10;
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $exam = [];
    public $classteacher, $user;
    public $examdetails, $examstatus, $absentstatus, $showexamdetailsmodal = false, $showexamstatusmodal = false;

    public function mount()
    {
        $this->user = auth()->guard('staff')->user();
        $this->today = Carbon::today();
        $this->classteacher = Assignsubject::where('staff_id', $this->user->id)
            ->where('is_classteacher', true)
            ->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function deleteconfirm($exam_id)
    {
        $this->dispatchBrowserEvent('deletetoast', ['exam_id' => $exam_id]);
    }

    public function delete(Exam $exam)
    {
        try {
            DB::beginTransaction();

            $exam->delete();
            Examsubject::where('exam_id', $exam->id)->delete();
            Examstudentlist::where('exam_id', $exam->id)->delete();
            Examstudentsubjectlist::where('exam_id', $exam->id)->delete();
            Helper::trackmessage($this->user, 'Admin Exam Delete', 'admin_web_exam_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Exam Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('delete', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('delete', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('delete', 'three', $e);
        }
    }

    public function openexamdetailsmodal(Exam $exam)
    {
        $this->examdetails = $exam;
        $this->showexamdetailsmodal = true;
    }

    public function closeexamdetailsmodal()
    {
        $this->showexamdetailsmodal = false;
    }

    public function openexamstatusmodal(Exam $exam)
    {
        $this->examstatus = $exam;
        $this->absentstatus = Examstudentsubjectlist::where('exam_id', $exam->id)->get();
        $this->showexamstatusmodal = true;
    }

    public function closeexamstatusmodal()
    {
        $this->showexamstatusmodal = false;
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        if (!$this->classmaster_id) {
            $this->section_id = '';
        }
        $examlist = Exam::where('academicyear_id', $this->academicyear_id)
            ->where(fn($query) => $query->where('classmaster_id', $this->classmaster_id))
            ->where(fn($query) => $query->whereJsonContains('section', $this->section_id))
            ->latest()
            ->get();

        return view('livewire.staff.exam.createexam.staffexamcreateviewindexlivewire', compact('examlist'));
    }
}
