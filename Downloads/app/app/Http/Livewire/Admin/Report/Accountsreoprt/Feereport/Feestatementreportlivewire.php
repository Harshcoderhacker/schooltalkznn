<?php

namespace App\Http\Livewire\Admin\Report\Accountsreoprt\Feereport;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;
use Livewire\WithPagination;

class Feestatementreportlivewire extends Component
{
    use WithPagination;
    public $classmasterid, $sectionid, $studentid;

    public $classmaster;
    public $section = [];
    public $student = [];
    public $studentdetails = [];
    public $paginationlength = 10;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function updatedSectionid()
    {
        $this->studentid = '';
        if ($this->sectionid) {
            $this->student = Student::isaccountactive()
                ->where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->get();
        } else {
            $this->student = [];
        }
    }

    public function updatedStudentid()
    {
        if ($this->studentid) {
            $this->studentdetails = Student::find($this->studentid);
        } else {
            $this->studentdetails = [];
        }
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function downloadfeestatement()
    {
        $feeassignstudent = Feeassignstudent::with('feemaster')
            ->where('student_id', $this->studentid)->get();
        $studentdetails = $this->studentdetails;
        $pdf = Pdf::loadView('admin.report.accountsreport.feereport.pdf.feestatementreportpdf',
            compact('feeassignstudent', 'studentdetails'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Fee Statuement Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Studentfeestatement.pdf');

    }

    public function render()
    {
        $feeassignstudent = Feeassignstudent::with('feemaster')
            ->where('student_id', $this->studentid)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.report.accountsreoprt.feereport.feestatementreportlivewire', ['feeassignstudent' => $feeassignstudent]);
    }
}
