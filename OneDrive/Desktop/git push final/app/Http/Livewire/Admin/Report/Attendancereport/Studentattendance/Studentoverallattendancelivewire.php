<?php

namespace App\Http\Livewire\Admin\Report\Attendancereport\Studentattendance;

use App\Exports\Admin\Report\Attendance\Student\StudentoverallattendanceExport;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Studentoverallattendancelivewire extends Component
{
    public $classmasterid, $sectionid, $monthid, $academicyearmonthlist;

    public $classmaster, $section, $academicyear_id;
    public $studentlist, $studentattendance;
    public $downloadtype = 1;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->academicyearmonthlist = Academicyear::find($this->academicyear_id)->academicyearmonthlist;
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

    public function downloadattendance()
    {

        $studentattendance = $this->studentattendance;
        $studentlist = $this->studentlist;
        $academicyearmonthlist = $this->academicyearmonthlist;
        $academicyear_id = $this->academicyear_id;

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new StudentoverallattendanceExport($studentattendance, $studentlist, $academicyearmonthlist, $academicyear_id), 'Studentoverallattendance.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF
            $pdf = Pdf::loadView('admin.report.attendancereport.studentattendancereport.pdf.studentoverallattendancereport',
                compact('studentattendance', 'studentlist', 'academicyearmonthlist', 'academicyear_id'))
                ->setPaper('a3', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Attendance Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Studentattendance.pdf');
        }

    }

    public function render()
    {
        $this->studentattendance = Studentattendance::with('studentattendancelist')
            ->where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->get();

        $this->studentlist = Student::where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->get();

        return view('livewire.admin.report.attendancereport.studentattendance.studentoverallattendancelivewire');
    }
}
