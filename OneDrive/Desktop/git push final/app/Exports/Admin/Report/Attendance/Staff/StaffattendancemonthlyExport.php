<?php

namespace App\Exports\Admin\Report\Attendance\Staff;

use App\Models\Admin\Staff\Attendance\Staffattendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StaffattendancemonthlyExport implements FromView
{

    protected $staffattendance;
    protected $stafflist;
    protected $month_string;
    protected $academicyear_id;

    public function __construct($staffattendance, $stafflist, $month_string, $academicyear_id)
    {
        $this->staffattendance = $staffattendance;
        $this->stafflist = $stafflist;
        $this->month_string = $month_string;
        $this->academicyear_id = $academicyear_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    // public function collection()
    // {
    //     return Studentattendance::all();
    // }

    public function view(): View
    {
        return view('admin.report.attendancereport.staffattendancereport.pdf.staffmonthlyattendancereport', [
            'staffattendance' => $this->staffattendance,
            'stafflist' => $this->stafflist,
            'month_string' => $this->month_string,
            'academicyear_id' => $this->academicyear_id,
        ]);
    }
}
