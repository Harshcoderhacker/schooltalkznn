<?php

namespace App\Http\Livewire\Admin\Report\Leaderboardreport;

use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Classleaderboardreportlivewire extends Component
{
    public $classmaster, $classmaster_id, $academicyear, $month, $year, $month_string, $acadamicmonthid, $student, $starcount, $classleaderboard = [];
    public $from_date, $to_date;
    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->academicyear = Academicyear::find(App::make('generalsetting')->academicyear_id);
    }
    public function updatedClassmasterid()
    {
        $this->acadamicmonthid = '';
    }
    public function updatedAcadamicmonthid()
    {
        if ($this->acadamicmonthid != 0 && $this->acadamicmonthid != '') {
            $this->month = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month;
            $this->year = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->year;
            $this->month_string = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string;
        } else {
            $this->month = 13;
            $this->month_string = '';
            $this->from_date = $this->academicyear->start_date;
            $this->to_date = $this->academicyear->end_date;
        }
    }
    public function downloadclassleaderboardreport()
    {
        $classleaderboard = $this->classleaderboard();
        $starcount = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT')
                    ->where('classmaster_id', $this->classmaster_id);

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
        $classmaster = $this->classmaster->find($this->classmaster_id)->name;
        $month = $this->month;
        $month_string = $this->month_string;
        $academicyear = $this->academicyear->year;
        $pdf = Pdf::loadView('admin.report.leaderboardreport.pdf.classleaderboardreport', compact('classleaderboard', 'starcount', 'classmaster', 'month', 'month_string', 'academicyear'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Class Leaderboard Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Classleaderboardreport.pdf');
    }
    protected function classleaderboard()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT')
                    ->where('classmaster_id', $this->classmaster_id);

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
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT')
                    ->where('classmaster_id', $this->classmaster_id);

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
                ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();
        } else {
            return [];
        }

    }

    public function render()
    {
        $this->classleaderboard = $this->classleaderboard();
        return view('livewire.admin.report.leaderboardreport.classleaderboardreportlivewire');
    }
}
