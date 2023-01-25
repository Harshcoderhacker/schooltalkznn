<?php

namespace App\Http\Livewire\Admin\Report\Attendancereport\Staffattendance;

use App\Exports\Admin\Report\Attendance\Staff\StaffoverallattendanceExport;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Staff\Auth\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Staffoverallattendancelivewire extends Component
{
    public $desginationid, $monthid, $academicyearmonthlist;

    public $desgination, $academicyear_id;
    public $stafflist, $staffattendance;
    public $downloadtype = 1;

    public function mount()
    {
        $this->desgination = Staffdesignation::where('active', true)->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->academicyearmonthlist = Academicyear::find($this->academicyear_id)->academicyearmonthlist;
    }

    public function downloadattendance()
    {

        $staffattendance = $this->staffattendance;
        $stafflist = $this->stafflist;
        $academicyearmonthlist = $this->academicyearmonthlist;
        $academicyear_id = $this->academicyear_id;

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new StaffoverallattendanceExport($staffattendance, $stafflist, $academicyearmonthlist, $academicyear_id), 'Staffoverallattendance.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF
            $pdf = Pdf::loadView('admin.report.attendancereport.staffattendancereport.pdf.staffoverallattendancereport',
                compact('staffattendance', 'stafflist', 'academicyearmonthlist', 'academicyear_id'))
                ->setPaper('a3', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Attendance Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Staffattendance.pdf');
        }

    }

    public function render()
    {
        $this->staffattendance = Staffattendance::where('academicyear_id', $this->academicyear_id)
            ->where('staffdesignation_id', $this->desginationid)
            ->get();

        $this->stafflist = Staff::where('staffdesignation_id', $this->desginationid)
            ->get();

        return view('livewire.admin.report.attendancereport.staffattendance.staffoverallattendancelivewire');
    }
}
