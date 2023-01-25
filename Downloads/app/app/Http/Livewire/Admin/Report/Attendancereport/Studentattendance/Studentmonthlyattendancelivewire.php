<?php

namespace App\Http\Livewire\Admin\Report\Attendancereport\Studentattendance;

use App\Exports\Admin\Report\Attendance\Student\StudentattendancemonthlyExport;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Studentmonthlyattendancelivewire extends Component
{
    public $classmasterid, $sectionid, $studentid, $attendancemonth;

    public $classmaster, $section;

    public $studentattendance, $studentlist;

    public $downloadtype, $month_string;

    public $academicyear_id;

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
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
        $month_string = $this->month_string;
        $academicyear_id = $this->academicyear_id;

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new StudentattendancemonthlyExport($studentattendance, $studentlist, $month_string, $academicyear_id), 'Studentattendance.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF
            $pdf = Pdf::loadView('admin.report.attendancereport.studentattendancereport.pdf.studentmonthlyattendancereport',
                compact('studentattendance', 'studentlist', 'month_string', 'academicyear_id'))
                ->setPaper('a4', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Attendance Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Studentattendance.pdf');
        }

    }

    public function render()
    {

        $month = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->month : null;
        $year = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->year : null;
        $this->month_string = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->format('F Y') : null;
        $this->studentattendance = Studentattendance::with('studentattendancelist')
            ->where('classmaster_id', $this->classmasterid)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('section_id', $this->sectionid)
            ->whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->orderBy('attendance_date')
            ->get();

        $this->studentlist = Student::with(['studentattendancelist' =>
            fn($q) => $q->whereHas('studentattendance', fn(Builder $query) =>
                $query->whereMonth('attendance_date', $month)
                    ->whereYear('attendance_date', $year)
            )])
            ->where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->get();

        return view('livewire.admin.report.attendancereport.studentattendance.studentmonthlyattendancelivewire');
    }
}
