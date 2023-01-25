<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Admin\Emotioncapture\Emotioncapture;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Emotioncapturedashboardlivewire extends Component
{
    public $classmaster, $classmaster_id = 1, $select_day = 1, $academicyear_id;
    public $studentneedattentionrightnav = false;
    public $studentfellinghappyrightnav = false;
    public $studentfellingdisturbedrightnav = false;
    public $classesneedsattention, $studentsneedsattention, $selectedclass, $classmaster_name, $selectedclassstudents, $selected_classmaster_name;
    public $disturbed, $scared, $totalstudent, $emotionselectedday = 1, $classemotionfilter = 0, $emotions, $noofstudents, $emotionselectedclass, $emotion_status;
    public $classneedsattentioncount = [];
    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
    }

    public function openstudentfellingmodal($emotion_status)
    {
        $this->studentfellinghappyrightnav = true;
        $this->emotion_status = $emotion_status;
    }

    // public function openstudentfellingdisturbedmodal($selectedclass)
    // {
    //     $this->selected_classmaster_name = $this->classmaster->find($selectedclass)->name;
    //     $this->totalstudent = Student::where('classmaster_id', $selectedclass)->count();
    //     $selectedclassstudents = Student::where('active', true)
    //         ->where('classmaster_id', $this->classmaster_id)
    //         ->where('academicyear_id', $this->academicyear_id)
    //         ->addSelect(['distrubed' => Emotioncapture::selectRaw('count(*) as distrubed')
    //                 ->where('emotionstatus', 4)
    //                 ->where(function ($query) {
    //                     switch ($this->select_day) {
    //                         case 1:
    //                             $query->whereDate('emotioncapturedate', Carbon::today());
    //                             break;
    //                         case 2:
    //                             $query->whereBetween('emotioncapturedate',
    //                                 [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    //                             break;
    //                         case 3:
    //                             $query->whereMonth('emotioncapturedate', Carbon::now()->month);
    //                             break;
    //                         default:
    //                             break;
    //                     }
    //                 })
    //                 ->whereColumn('student_id', 'students.id')
    //                 ->groupBy('student_id'),
    //         ])
    //         ->addSelect(['scared' => Emotioncapture::selectRaw('count(*) as scared')
    //                 ->where('emotionstatus', 5)
    //                 ->where(function ($query) {
    //                     switch ($this->select_day) {
    //                         case 1:
    //                             $query->whereDate('emotioncapturedate', Carbon::today());
    //                             break;
    //                         case 2:
    //                             $query->whereBetween('emotioncapturedate',
    //                                 [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
    //                             break;
    //                         case 3:
    //                             $query->whereMonth('emotioncapturedate', Carbon::now()->month);
    //                             break;
    //                         default:
    //                             break;
    //                     }
    //                 })
    //                 ->whereColumn('student_id', 'students.id')
    //                 ->groupBy('student_id'),
    //         ])
    //         ->orderBy('distrubed', "DESC")
    //         ->get();

    //     if (count($selectedclassstudents)) {
    //         $this->selectedclassstudents = $selectedclassstudents;
    //     } else {
    //         $this->selectedclassstudents = [];
    //     }
    //     $this->studentfellingdisturbedrightnav = true;
    // }

    public function openstudentneedattentionmodal()
    {
        $this->classmaster_name = $this->classmaster->find($this->classmaster_id)->name;
        $this->studentneedattentionrightnav = true;
    }

    public function closestudentneedattentionmodal()
    {
        $this->studentneedattentionrightnav = false;
    }

    public function closestudentfeelinghappymodal()
    {
        $this->studentfellinghappyrightnav = false;
    }
    public function closestudentfeelingdisturbedmodal()
    {

        $this->studentfellingdisturbedrightnav = false;
    }

    protected function studentrecord()
    {
        $studentsneedsattention = Student::where('active', true)
            ->where('classmaster_id', $this->classmaster_id)
            ->where('academicyear_id', $this->academicyear_id)
            ->addSelect(['needattention' => Emotioncapture::selectRaw('count(*) as needattention')
                    ->where(function ($query) {
                        $query->where('emotionstatus', 4)
                            ->orwhere('emotionstatus', 5);
                    })
                    ->where(function ($query) {
                        switch ($this->select_day) {
                            case 1:
                                $query->whereDate('emotioncapturedate', Carbon::today());
                                break;
                            case 2:
                                $query->whereBetween('emotioncapturedate',
                                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                                break;
                            case 3:
                                $query->whereMonth('emotioncapturedate', Carbon::now()->month);
                                break;
                            default:
                                break;
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['distrubed' => Emotioncapture::selectRaw('count(*) as distrubed')
                    ->where('emotionstatus', 4)
                    ->where(function ($query) {
                        switch ($this->select_day) {
                            case 1:
                                $query->whereDate('emotioncapturedate', Carbon::today());
                                break;
                            case 2:
                                $query->whereBetween('emotioncapturedate',
                                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                                break;
                            case 3:
                                $query->whereMonth('emotioncapturedate', Carbon::now()->month);
                                break;
                            default:
                                break;
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->addSelect(['scared' => Emotioncapture::selectRaw('count(*) as scared')
                    ->where('emotionstatus', 5)
                    ->where(function ($query) {
                        switch ($this->select_day) {
                            case 1:
                                $query->whereDate('emotioncapturedate', Carbon::today());
                                break;
                            case 2:
                                $query->whereBetween('emotioncapturedate',
                                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                                break;
                            case 3:
                                $query->whereMonth('emotioncapturedate', Carbon::now()->month);
                                break;
                            default:
                                break;
                        }
                    })
                    ->whereColumn('student_id', 'students.id')
                    ->groupBy('student_id'),
            ])
            ->orderBy('needattention', "DESC")
            ->get();

        if (count($studentsneedsattention)) {
            $this->studentsneedsattention = $studentsneedsattention;
        } else {
            $this->studentsneedsattention = [];
        }
    }

    protected function classesneedsattention()
    {
        $query = Emotioncapture::query();

        $query->when($this->select_day == 1, function ($q) {
            return $q->whereDate('emotioncapturedate', Carbon::today())
                ->where(function ($query) {
                    $query->where('emotionstatus', 4)
                        ->orwhere('emotionstatus', 5);
                });
        });
        $query->when($this->select_day == 2, function ($q) {
            return $q->whereBetween('emotioncapturedate',
                [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                ->where(function ($query) {
                    $query->where('emotionstatus', 4)
                        ->orwhere('emotionstatus', 5);
                });
        });
        $query->when($this->select_day == 3, function ($q) {
            return $q->whereMonth('emotioncapturedate', Carbon::now()->month)
                ->where(function ($query) {
                    $query->where('emotionstatus', 4)
                        ->orwhere('emotionstatus', 5);
                });
        });

        $query->when($this->select_day == 4, function ($q) {
            return $q->where('academicyear_id', $this->academicyear_id)
                ->where(function ($query) {
                    $query->where('emotionstatus', 4)
                        ->orwhere('emotionstatus', 5);
                });
        });
        $classesneedsattention = $query->get();
        $classneedsattentioncount = [];
        if ($classesneedsattention) {
            $this->classesneedsattention = $classesneedsattention;
            foreach ($this->classesneedsattention as $value) {
                $classneedsattentioncount[$value->classmaster_id] = 0;
                $this->disturbed[$value->classmaster_id] = 0;
                $this->scared[$value->classmaster_id] = 0;
            }
            foreach ($this->classesneedsattention as $value) {
                $classneedsattentioncount[$value->classmaster_id] += 1;
                switch ($value->emotionstatus) {
                    case 4:
                        $this->disturbed[$value->classmaster_id] += 1;
                        break;
                    case 5:
                        $this->scared[$value->classmaster_id] += 1;
                        break;
                }
            }
            if ($classneedsattentioncount) {
                krsort($classneedsattentioncount);
            }
            $count = 0;
            foreach ($classneedsattentioncount as $key => $value) {
                $this->classneedsattentioncount[$count] = $key;

                $count += 1;
            }
        } else {
            $this->classneedsattentioncount = [];
        }
    }

    protected function emotionpercentage()
    {
        $query = Emotioncapture::query();
        $query->when(($this->emotionselectedday == 1), function ($q) {
            if ($this->classemotionfilter == 0) {
                return $q->where('active', true)
                    ->where('academicyear_id', $this->academicyear_id)
                    ->whereDate('emotioncapturedate', Carbon::today());
            } else {
                return $q->where('active', true)
                    ->where('academicyear_id', $this->academicyear_id)
                    ->where('classmaster_id', $this->classemotionfilter)
                    ->whereDate('emotioncapturedate', Carbon::today());
            }
        });
        $query->when($this->emotionselectedday == 2, function ($q) {
            if ($this->classemotionfilter == 0) {
                return $q->where('active', true)
                    ->where('academicyear_id', $this->academicyear_id)
                    ->whereBetween('emotioncapturedate',
                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            } else {
                return $q->whereBetween('emotioncapturedate',
                    [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
                    ->where('academicyear_id', $this->academicyear_id)
                    ->where('classmaster_id', $this->classemotionfilter);
            }
        });
        $query->when($this->emotionselectedday == 3, function ($q) {
            if ($this->classemotionfilter == 0) {
                return $q->whereMonth('emotioncapturedate', Carbon::now()->month)
                    ->where('active', true)
                    ->where('academicyear_id', $this->academicyear_id);
            } else {
                return $q->whereMonth('emotioncapturedate', Carbon::now()->month)
                    ->where('academicyear_id', $this->academicyear_id)
                    ->where('classmaster_id', $this->classemotionfilter);
            }
        });
        $query->when($this->emotionselectedday == 4, function ($q) {
            if ($this->classemotionfilter == 0) {
                return $q->where('academicyear_id', $this->academicyear_id)
                    ->where('active', true);
            } else {
                return $q->where('academicyear_id', $this->academicyear_id)
                    ->where('classmaster_id', $this->classemotionfilter);
            }

        });

        $emotions = $query->get();
        if ($this->classemotionfilter == 0) {
            $this->noofstudents = Student::where('active', true)->where('is_accountactive', true)->where('academicyear_id', $this->academicyear_id)
                ->select('roll_no', 'name', 'classmaster_id')
                ->addSelect(['happy' => Emotioncapture::selectRaw('count(*) as distrubed')
                        ->where('emotionstatus', $this->emotion_status)
                        ->where(function ($query) {
                            switch ($this->select_day) {
                                case 1:
                                    $query->whereDate('emotioncapturedate', Carbon::today());
                                    break;
                                case 2:
                                    $query->whereBetween('emotioncapturedate',
                                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                                    break;
                                case 3:
                                    $query->whereMonth('emotioncapturedate', Carbon::now()->month);
                                    break;
                                default:
                                    break;
                            }
                        })
                        ->whereColumn('student_id', 'students.id')
                        ->groupBy('student_id'),
                ])
                ->get();
        } else {
            $this->emotionselectedclass = Classmaster::find($this->classemotionfilter)->name;
            $this->noofstudents = Student::where('active', true)->where('is_accountactive', true)->where('academicyear_id', $this->academicyear_id)
                ->select('roll_no', 'name', 'classmaster_id')
                ->addSelect(['happy' => Emotioncapture::selectRaw('count(*) as distrubed')
                        ->where('emotionstatus', $this->emotion_status)
                        ->where(function ($query) {
                            switch ($this->select_day) {
                                case 1:
                                    $query->whereDate('emotioncapturedate', Carbon::today());
                                    break;
                                case 2:
                                    $query->whereBetween('emotioncapturedate',
                                        [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
                                    break;
                                case 3:
                                    $query->whereMonth('emotioncapturedate', Carbon::now()->month);
                                    break;
                                default:
                                    break;
                            }
                        })
                        ->whereColumn('student_id', 'students.id')
                        ->groupBy('student_id'),
                ])
                ->where('classmaster_id', $this->classemotionfilter)->get();
        }
        if ($emotions) {
            $this->emotions = $emotions;
        } else {
            $this->emotions = [];
        }

    }

    public function render()
    {
        $this->studentrecord();
        $this->classesneedsattention();
        $this->emotionpercentage();

        return view('livewire.admin.dashboard.emotioncapturedashboardlivewire');
    }
}
