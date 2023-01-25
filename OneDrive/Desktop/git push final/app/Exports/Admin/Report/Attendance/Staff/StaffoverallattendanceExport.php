<?php

namespace App\Exports\Admin\Report\Attendance\Staff;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StaffoverallattendanceExport implements FromView
{

    protected $staffattendance;
    protected $stafflist;

    public function __construct($staffattendance, $stafflist, $academicyearmonthlist, $academicyear_id)
    {
        $this->staffattendance = $staffattendance;
        $this->stafflist = $stafflist;
        $this->academicyearmonthlist = $academicyearmonthlist;
        $this->academicyear_id = $academicyear_id;
    }

    public function view(): View
    {
        return view('admin.report.attendancereport.staffattendancereport.pdf.staffoverallattendancereport', [
            'staffattendance' => $this->staffattendance,
            'stafflist' => $this->stafflist,
            'academicyearmonthlist' => $this->academicyearmonthlist,
            'academicyear_id' => $this->academicyear_id,
        ]);
    }
}
