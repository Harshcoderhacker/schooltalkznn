<?php

namespace App\Http\Livewire\Admin\Report\Attendancereport\Staffattendance;

use App\Exports\Admin\Report\Attendance\Staff\StaffattendancemonthlyExport;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Staff\Auth\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;

class Staffmonthlyattendancelivewire extends Component
{
    public $staffdesignation, $attendancemonth, $month_string;

    public $staffdesignation_id, $staffid;

    public $staffattendance, $stafflist;

    public $downloadtype, $academicyear_id;

    public function mount()
    {
        $this->staffdesignation = Staffdesignation::where('active', true)->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function downloadattendance()
    {
        $staffattendance = $this->staffattendance;
        $stafflist = $this->stafflist;
        $month_string = $this->month_string;
        $academicyear_id = $this->academicyear_id;

        $exportype = collect(["1", "2", "3"]);

        if ($exportype->contains($this->downloadtype)) { //xlsx", "xls", "csv"
            return Excel::download(new StaffattendancemonthlyExport($staffattendance, $stafflist, $month_string, $academicyear_id), 'Staffattendance.' . ["xlsx", "xls", "csv"][$this->downloadtype - 1]);
        }

        if ($this->downloadtype == 4) { // PDF

            $pdf = Pdf::loadView('admin.report.attendancereport.staffattendancereport.pdf.staffmonthlyattendancereport',
                compact('staffattendance', 'stafflist', 'month_string', 'academicyear_id'))
                ->setPaper('a4', 'landscape')
                ->output();

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Attendance Download Intiated']);
            return response()->streamDownload(fn() => print($pdf), 'Staffattendance.pdf');
        }

    }

    public function render()
    {
        $month = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->month : null;
        $year = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->year : null;
        $this->month_string = $this->attendancemonth ? Carbon::parse($this->attendancemonth)->format('F Y') : null;

        $this->staffattendance = Staffattendance::with('staffattendancelist')
            ->where('staffdesignation_id', $this->staffdesignation_id)
            ->whereMonth('attendance_date', $month)
            ->whereYear('attendance_date', $year)
            ->orderBy('attendance_date')
            ->get();

        $this->stafflist = Staff::with(['staffattendancelist' =>
            fn($q) => $q->whereHas('staffattendance', fn(Builder $query) =>
                $query->whereMonth('attendance_date', $month)
                    ->whereYear('attendance_date', $year)
            )])
            ->where('staffdesignation_id', $this->staffdesignation_id)
            ->get();

        return view('livewire.admin.report.attendancereport.staffattendance.staffmonthlyattendancelivewire');
    }
}
