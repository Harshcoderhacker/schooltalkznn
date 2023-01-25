<?php

namespace App\Http\Livewire\Admin\Report\Leaderboardreport;

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Staff\Auth\Staff;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Staffleaderboardreportlivewire extends Component
{
    public $academicyear, $month, $year, $month_string, $acadamicmonthid, $starcount, $staffleaderboard = [];
    public $from_date, $to_date;

    public function mount()
    {
        $this->academicyear = Academicyear::find(App::make('generalsetting')->academicyear_id);
    }
    public function updatedAcadamicmonthid()
    {
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
    }
    public function downloadclassleaderboardreport()
    {
        $staffleaderboard = $this->staffleaderboard();
        $starcount = Gamification::whereHasMorph('gamificationable',
            [Staff::class],
            function (Builder $query, $type) {
                $column = $type === Staff::class;
                $query->where('usertype', 'STAFF');

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
        $academicyear = $this->academicyear->year;
        $pdf = Pdf::loadView('admin.report.leaderboardreport.pdf.staffleaderboardreport', compact('staffleaderboard', 'starcount', 'month', 'month_string', 'academicyear'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Leaderboard Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Staffleaderboardreport.pdf');
    }
    protected function staffleaderboard()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Staff::class],
            function (Builder $query, $type) {
                $column = $type === Staff::class;
                $query->where('usertype', 'STAFF');

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
        $this->starcount = $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Staff::class],
            function (Builder $query, $type) {
                $column = $type === Staff::class;
                $query->where('usertype', 'STAFF');

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
            return Staff::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
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
    public function countdetails()
    {
        $this->postcount = Feedpost::where('type', 1)
            ->where('feedpostable_type', 'App\Models\Staff\Auth\Staff')
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->count();

        $this->achievementcount = Feedpost::where('type', 2)
            ->where('feedpostable_type', 'App\Models\Staff\Auth\Staff')
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->count();

        $this->pollcount = Feedpost::where('type', 3)
            ->where('feedpostable_type', 'App\Models\Staff\Auth\Staff')
            ->where(function ($query) {
                if ($this->month != 13) {
                    $query->whereMonth('created_at', $this->month)->whereYear('created_at', $this->year);
                } else {
                    $query->whereBetween('created_at', [$this->from_date, $this->to_date]);
                }

            })
            ->count();
    }
    public function render()
    {
        $this->staffleaderboard = $this->staffleaderboard();
        return view('livewire.admin.report.leaderboardreport.staffleaderboardreportlivewire');
    }
}
