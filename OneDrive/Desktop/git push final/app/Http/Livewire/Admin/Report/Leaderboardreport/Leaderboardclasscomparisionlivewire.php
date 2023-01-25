<?php

namespace App\Http\Livewire\Admin\Report\Leaderboardreport;

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Livewire\Component;

class Leaderboardclasscomparisionlivewire extends Component
{
    public $academicyear, $classmaster = [], $classmaster_id, $month, $year, $month_string, $acadamicmonthid, $starcount = [], $classcomparison = [];
    public $postcount = [], $achievementcount = [], $pollcount = [], $from_date, $to_date;
    public function mount()
    {
        $this->academicyear = Academicyear::find(App::make('generalsetting')->academicyear_id);
    }
    public function updatedAcadamicmonthid()
    {
        if ($this->acadamicmonthid != 0 && $this->acadamicmonthid != '') {
            $this->month = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month;
            $this->year = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->year;
            $from_date = new Carbon('first day of ' . $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string);
            $from_date = $from_date->format('Y-m-d');
            $to_date = new Carbon('last day of ' . $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string);
            $this->to_date = $to_date->format('Y-m-d');
            $this->month_string = $this->academicyear->academicyearmonthlist->find($this->acadamicmonthid)->month_string;
        } else {
            $this->month = 13;
            $this->from_date = $this->academicyear->start_date;
            $this->to_date = $this->academicyear->end_date;
            $this->month_string = '';
        }
    }
    public function downloadleaderboardclasscomparisionreport()
    {
        $classmaster = $this->classmaster;
        $postcount = $this->postcount;
        $achievementcount = $this->achievementcount;
        $pollcount = $this->pollcount;
        $starcount = $this->starcount;
        $month = $this->month;
        $month_string = $this->month_string;
        $academicyear = $this->academicyear->year;
        $pdf = Pdf::loadView('admin.report.leaderboardreport.pdf.leaderboardcomparisonreport', compact('postcount', 'achievementcount', 'pollcount', 'starcount', 'month', 'month_string', 'classmaster', 'academicyear'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Leaderboard Class Comparison Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Leaderboardcomparisonreport.pdf');
    }
    protected function leaderboardcomparsion()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $postcount = 0;
        $pollcount = 0;
        $achievementcount = 0;
        foreach ($this->classmaster as $key => $eachclassmaster) {
            $this->classmaster_id = $eachclassmaster->id;
            $gamification = Gamification::whereHasMorph('gamificationable',
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
                ->selectRaw('sum(star) as starcount')
                ->get();
            $student = Student::where('classmaster_id', $this->classmaster_id)->get();
            foreach ($student as $eachstudent) {
                if ($this->month) {
                    $postcount += $eachstudent->feedpost->whereBetween('created_at', [$this->from_date, $this->to_date])->count();
                    $achievementcount += $eachstudent->feedachievement->whereBetween('created_at', [$this->from_date, $this->to_date])->count();
                    $pollcount += $eachstudent->feedpoll->whereBetween('created_at', [$this->from_date, $this->to_date])->count();
                }
            }
            $this->postcount[$key] = $postcount;
            $postcount = 0;
            $this->achievementcount[$key] = $achievementcount;
            $achievementcount = 0;
            $this->pollcount[$key] = $pollcount;
            $pollcount = 0;
            $this->starcount[$key] = $gamification->sum('starcount');
        }
    }
    public function render()
    {
        $this->classcomparison = $this->leaderboardcomparsion();
        return view('livewire.admin.report.leaderboardreport.leaderboardclasscomparisionlivewire');
    }
}
