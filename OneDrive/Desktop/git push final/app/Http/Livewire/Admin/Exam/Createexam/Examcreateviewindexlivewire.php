<?php

namespace App\Http\Livewire\Admin\Exam\Createexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;

class Examcreateviewindexlivewire extends Component
{
    use WithPagination;

    public $today;
    public $paginationlength = 10;
    public $classmaster_id, $section_id, $exam_id, $academicyear_id;
    public $section, $classmaster, $exam = [];
    public $examdetails, $examstatus, $absentstatus, $showexamdetailsmodal = false, $showexamstatusmodal = false;

    public function mount()
    {
        $this->today = Carbon::today();
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->exam = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function updatedClassmasterid()
    {
        $this->section_id = '';
        if ($this->classmaster_id && is_numeric($this->classmaster_id)) {
            $this->section = Classmaster::find($this->classmaster_id)->section;
        } else {
            $this->section = [];
        }
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
            Helper::trackmessage(auth()->user(), 'Admin Exam Delete', 'admin_web_exam_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->resetPage();
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
        $examlist = Exam::where('active', true)
            ->where('academicyear_id', $this->academicyear_id)
            ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
            ->where(fn($query) => ($this->section_id) ? $query->whereJsonContains('section', $this->section_id) : '')
            ->latest()
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.exam.createexam.examcreateviewindexlivewire', compact('examlist'));
    }
}
