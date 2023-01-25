<?php

namespace App\Http\Controllers\Web\Admin\Report\Examreport;

use App\Http\Controllers\Controller;

class ExamreportController extends Controller
{
    public function marksheetreport()
    {
        return view('admin.report.examreport.marksheetreport');
    }

    public function classreport()
    {
        return view('admin.report.examreport.classreport');
    }

    public function classprogress()
    {
        return view('admin.report.examreport.classprogress');
    }

    public function studentprogress()
    {
        return view('admin.report.examreport.studentprogress');
    }
}
