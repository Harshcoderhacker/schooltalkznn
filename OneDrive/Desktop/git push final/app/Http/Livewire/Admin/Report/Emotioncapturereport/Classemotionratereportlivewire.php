<?php

namespace App\Http\Livewire\Admin\Report\Emotioncapturereport;

use App\Models\Admin\Emotioncapture\Emotioncapture;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Settings\Schoolsetting\Holiday;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Classemotionratereportlivewire extends Component
{
    public $classmaster, $classmasterid, $academicyear_id, $acadamicmonthid, $academicyear, $emotiondate, $month, $monthstring, $student, $studentsneedsattention, $studentneedattentioncount;
    public $positivity = [], $workingdays = [], $notupdated = [];
    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->academicyear = Academicyear::find(App::make('generalsetting')->academicyear_id);
        $this->academicyear_id = $this->academicyear->id;
    }

    public function updatedClassmasterid()
    {
        $this->emotiondate = '';
        $this->acadamicmonthid = '';
        $this->month = '';
        $this->studentsneedsattention = [];
    }
    public function updatedEmotiondate()
    {
        $this->acadamicmonthid = '';
        $this->studentrecord();
    }
    public function updatedAcadamicmonthid()
    {
        if ($this->acadamicmonthid != '') {
            $this->month = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month;
            $this->monthstring = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string;
            $this->studentrecord();
        } else {
            $this->emotiondate = '';
            $this->acadamicmonthid = '';
            $this->month = '';
            $this->studentsneedsattention = [];
        }
    }
    public function downloadclassemotionratereport()
    {
        $day = '';
        if ($this->monthstring) {
            $day = 'Month of ' . Carbon::parse($this->monthstring)->format('F Y');
        } else {
            $day = Carbon::parse($this->emotiondate)->format('F d,Y');
        }
        $student = $this->student;
        $positivity = $this->positivity;
        $notupdated = $this->notupdated;
        $studentneedattentioncount = Emotioncapture::where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where(function ($query) {
                $query->where('emotionstatus', 4)
                    ->orwhere('emotionstatus', 5);
            })
            ->where(function ($query) {
                if ($this->emotiondate) {
                    $query->whereDate('emotioncapturedate', $this->emotiondate);
                } else {
                    $query->whereMonth('created_at', $this->month);
                }
            })
            ->count();
        $studentsneedsattention = Student::where('active', true)
            ->where('classmaster_id', $this->classmasterid)
            ->where('academicyear_id', $this->academicyear_id)
            ->addSelect(['happy' => Emotioncapture::selectRaw('count(*) as happy')
                    ->where('emotionstatus', 1)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['excited' => Emotioncapture::selectRaw('count(*) as excited')
                    ->where('emotionstatus', 2)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['neutral' => Emotioncapture::selectRaw('count(*) as neutral')
                    ->where('emotionstatus', 3)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['scared' => Emotioncapture::selectRaw('count(*) as scared')
                    ->where('emotionstatus', 4)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['distrubed' => Emotioncapture::selectRaw('count(*) as distrubed')
                    ->where('emotionstatus', 5)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->get();
        $month = $this->month;
        $emotiondate = $this->emotiondate;
        $pdf = Pdf::loadView('admin.report.emotioncapturereport.pdf.classemotionrate', compact('student', 'positivity', 'notupdated', 'day', 'studentneedattentioncount', 'studentsneedsattention', 'month', 'emotiondate'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Class Emotion Rate Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Classemotionratereport.pdf');
    }

    protected function studentrecord()
    {
        $this->student = Student::where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->get();
        $this->studentneedattentioncount = Emotioncapture::where('academicyear_id', $this->academicyear_id)->where('classmaster_id', $this->classmasterid)
            ->where(function ($query) {
                $query->where('emotionstatus', 4)
                    ->orwhere('emotionstatus', 5);
            })
            ->where(function ($query) {
                if ($this->emotiondate) {
                    $query->whereDate('emotioncapturedate', $this->emotiondate);
                } else {
                    $query->whereMonth('created_at', $this->month);
                }
            })
            ->count();
        $studentsneedsattention = Student::where('active', true)
            ->where('classmaster_id', $this->classmasterid)
            ->where('academicyear_id', $this->academicyear_id)
            ->addSelect(['happy' => Emotioncapture::selectRaw('count(*) as happy')
                    ->where('emotionstatus', 1)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['excited' => Emotioncapture::selectRaw('count(*) as excited')
                    ->where('emotionstatus', 2)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['neutral' => Emotioncapture::selectRaw('count(*) as neutral')
                    ->where('emotionstatus', 3)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['scared' => Emotioncapture::selectRaw('count(*) as scared')
                    ->where('emotionstatus', 4)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['distrubed' => Emotioncapture::selectRaw('count(*) as distrubed')
                    ->where('emotionstatus', 5)
                    ->where(function ($query) {
                        if ($this->emotiondate) {
                            $query->whereDate('emotioncapturedate', $this->emotiondate);
                        } else {
                            $query->whereMonth('created_at', $this->month);
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->get();
        if ($this->month) {

            $day = Carbon::createFromFormat('Y-m-d H:s:i', Carbon::parse($this->monthstring)->year . '-' . $this->month . '-5 3:30:34');
            $count = 0;
            $count1 = 0;
            $dates = [];
            for ($i = 1; $i < $day->daysInMonth + 1; ++$i) {
                $date = Carbon::createFromDate(Carbon::parse($this->monthstring)->year, $this->month, $i)->format('Y-m-d');
                if ($this->month == Carbon::today()->month) {
                    if (Carbon::today() < $date) {
                        break;
                    }
                }
                $weekend = Weekend::where('shortname', Carbon::parse($date)->format('D'))->where('is_holiday', true)->get();
                if (sizeof($weekend) == 0) {
                    $dates[$count] = $date;
                    $count++;
                }
            }
            for ($i = 0; $i < $count; $i++) {
                $holidays = Holiday::where('active', true)
                    ->whereDate('start_date', '<=', $dates[$i])
                    ->whereDate('end_date', '>=', $dates[$i])
                    ->get();
                if (sizeof($holidays) == 0) {
                    $this->workingdays[$count1] = $dates[$i];
                    $count1++;
                }
            }
        }
        if (sizeof($studentsneedsattention) > 0) {
            $this->studentsneedsattention = $studentsneedsattention;
            if ($this->month) {
                if ($this->month == Carbon::today()->month) {
                    foreach ($studentsneedsattention as $key => $eachstudent) {
                        $excited = $eachstudent->excited ? $eachstudent->excited : 0;
                        $happy = $eachstudent->happy ? $eachstudent->happy : 0;
                        $neutral = $eachstudent->neutral ? $eachstudent->neutral : 0;
                        $scared = $eachstudent->scared ? $eachstudent->scared : 0;
                        $distrubed = $eachstudent->distrubed ? $eachstudent->distrubed : 0;
                        $eachstudentpositivity = 0;
                        $eachstudentpositivity = round((($excited + $happy) / sizeof($this->workingdays)) * 100);
                        $eachstudentupdated = $happy + $excited + $neutral + $scared + $distrubed;
                        $this->positivity[$key] = $eachstudentpositivity;
                        $this->notupdated[$key] = sizeof($this->workingdays) - $eachstudentupdated;
                    }
                }

            }
        } else {
            $this->studentsneedsattention = null;
        }
    }
    public function render()
    {
        return view('livewire.admin.report.emotioncapturereport.classemotionratereportlivewire');
    }
}
