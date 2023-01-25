<?php

namespace App\Exports\Admin\Report\Attendance\Student;

use App\Models\Admin\Student\Attendance\Studentattendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentoverallattendanceExport implements FromView
{

    protected $studentattendance;
    protected $studentlist;

    public function __construct($studentattendance, $studentlist, $academicyearmonthlist, $academicyear_id)
    {
        $this->studentattendance = $studentattendance;
        $this->studentlist = $studentlist;
        $this->academicyearmonthlist = $academicyearmonthlist;
        $this->academicyear_id = $academicyear_id;
    }

    public function view(): View
    {
        return view('admin.report.attendancereport.studentattendancereport.pdf.studentoverallattendancereport', [
            'studentattendance' => $this->studentattendance,
            'studentlist' => $this->studentlist,
            'academicyearmonthlist' => $this->academicyearmonthlist,
            'academicyear_id' => $this->academicyear_id,
        ]);
    }
}
