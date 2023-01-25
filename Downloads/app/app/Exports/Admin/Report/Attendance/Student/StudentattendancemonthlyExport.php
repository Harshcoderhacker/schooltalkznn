<?php

namespace App\Exports\Admin\Report\Attendance\Student;

use App\Models\Admin\Student\Attendance\Studentattendance;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class StudentattendancemonthlyExport implements FromView
{

    protected $studentattendance;
    protected $studentlist;
    protected $month_string;
    protected $academicyear_id;

    public function __construct($studentattendance, $studentlist, $month_string, $academicyear_id)
    {
        $this->studentattendance = $studentattendance;
        $this->studentlist = $studentlist;
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
        return view('admin.report.attendancereport.studentattendancereport.pdf.studentmonthlyattendancereport', [
            'studentattendance' => $this->studentattendance,
            'studentlist' => $this->studentlist,
            'month_string' => $this->month_string,
            'academicyear_id' => $this->academicyear_id,
        ]);
    }
}
