<?php

namespace App\Http\Livewire\Admin\Student;

use App\Models\Admin\Settings\Schoolsetting\Academicyearmonthlist;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Studentattendancedetailslivewire extends Component
{
    public $monthstring, $student, $academicyearmonthlist, $academicyear_id;

    public function mount($student)
    {
        $this->month_string = Carbon::now()->format('F Y');
        $this->student = $student;
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;

        $this->academicyearmonthlist = Academicyearmonthlist::whereDate('monthdate', '<=', Carbon::now())
            ->whereHas('academicyear', fn(Builder $q) => $q->where('id', $this->academicyear_id))
            ->get();
    }

    public function downloadattendacereport(Academicyearmonthlist $monthlist)
    {
        $student = $this->student;
        $studentattendance = Studentattendancelist::where('student_id', $student->id)
            ->whereHas('studentattendance', fn($q) => $q->whereYear('attendance_date', '=', $monthlist->year)->whereMonth('attendance_date', '=', $monthlist->month))
            ->get();

        $pdf = Pdf::loadView('admin.student.attendance.pdf.studentattendancereportpdf',
            compact('student', 'monthlist', 'studentattendance'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Attendance Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Studentattendancereport.pdf');
    }

    public function render()
    {
        return view('livewire.admin.student.studentattendancedetailslivewire');
    }
}
