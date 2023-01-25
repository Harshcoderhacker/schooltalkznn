<?php

namespace App\Http\Livewire\Admin\Report\Leaderboardreport;

use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Topstudentleaderboardreportlivewire extends Component
{
    public $academicyear, $ratinglist, $rating, $month, $year, $month_string, $acadamicmonthid, $starcount, $topleaderboard = [];
    public $from_date, $to_date;
    public function mount()
    {
        $this->ratinglist = [15];
        $this->academicyear = Academicyear::find(App::make('generalsetting')->academicyear_id);
    }
    public function updatedAcadamicmonthid()
    {
        $this->rating = '';
        if ($this->acadamicmonthid != 0 && $this->acadamicmonthid != '') {
            $this->month = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month;
            $this->year = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->year;
            $this->month_string = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string;
        } else {
            $this->month = 13;
            $this->from_date = $this->academicyear->start_date;
            $this->to_date = $this->academicyear->end_date;
            $this->month_string = '';
        }
        $this->topleaderboard = [];
    }
    // public function updatedRating()
    // {
    //     if ($this->rating != 5) {
    //         $this->topleaderboard = $this->schoolleaderboard();
    //     }
    // }
    public function downloadtopstudentleaderboardreport()
    {
        $topleaderboard = $this->schoolleaderboard();
        $starcount = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT');

            })
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount');
        $month = $this->month;
        $month_string = $this->month_string;
        $rating = $this->ratinglist[$this->rating];
        $academicyear = $this->academicyear->year;
        $pdf = Pdf::loadView('admin.report.leaderboardreport.pdf.topstudentleaderboardreport', compact('topleaderboard', 'starcount', 'month', 'month_string', 'rating', 'academicyear'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Top Student Leaderboard Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Topstudentleaderboardreport.pdf');
    }
    protected function schoolleaderboard()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class;
                $query->where('usertype', 'STUDENT');

            })
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount')
            ->take(15);
        $this->starcount = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class;
                $query->where('usertype', 'STUDENT');

            })
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount');
        $ids_ordered = implode(',', $gamificationstarsequence->pluck('gamificationable_id')->toArray());
        if ($ids_ordered) {
            return Student::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
                ->withCount([
                    'feedpost',
                    'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
                    'feedpost as achievement_count' => fn(Builder $query) => $query->where('type', 2),
                    'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
                ])
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();
        } else {
            return [];
        }

    }
    public function render()
    {
        $this->topleaderboard = $this->schoolleaderboard();
        return view('livewire.admin.report.leaderboardreport.topstudentleaderboardreportlivewire');
    }
}
