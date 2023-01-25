<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Schooltalkzdashboardlivewire extends Component
{
    public $from_date, $to_date;

    public $select_day = 1;

    public $classmaster_id = 1;

    public $classmaster;

    public $showinactiveuserrightnav = false;
    public $classleaderboardrightnav = false;
    public $schoolleaderboardrightnav = false;

    public $classleaderboardallstudent = [];
    public $schoolleaderboardallstudent = [];

    public function mount()
    {
        $this->from_date = Carbon::today()->startOfDay();
        $this->to_date = Carbon::today()->endOfDay();
        $this->classmaster = Classmaster::where('active', true)->get();
    }

    public function Updatedselectday()
    {
        switch ($this->select_day) {
            case 1:
                $this->from_date = Carbon::today()->startOfDay();
                $this->to_date = Carbon::today()->endOfDay();
                break;
            case 2:
                $this->from_date = Carbon::now()->startOfWeek();
                $this->to_date = Carbon::now()->endOfWeek();
                break;
            case 3:
                $this->from_date = Carbon::now()->firstOfMonth();
                $this->to_date = Carbon::now()->endOfMonth();
                break;
            case 4:
                $this->from_date = Carbon::create(2022, 1, 1, 0, 0, 0);
                $this->to_date = Carbon::now();
                break;
        }

    }

    public function countdetails()
    {
        $atcive_user = User::whereHas('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->count() +
        Staff::whereHas('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->count() +
        Student::whereHas('aparent', fn(Builder $q) =>
            $q->whereHas('logininfos', fn(Builder $q) =>
                $q->whereBetween('created_at', [$this->from_date, $this->to_date])
            )
        )->count();

        $inatcive_user = User::whereDoesntHave('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->count() +
        Staff::whereDoesntHave('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->count() +
        Student::whereHas('aparent', fn(Builder $q) =>
            $q->whereDoesntHave('logininfos', fn(Builder $q) =>
                $q->whereBetween('created_at', [$this->from_date, $this->to_date])
            )
        )->count();

        $postcount = Feedpost::where('type', 1)
            ->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->count();

        $achievementcount = Feedpost::where('type', 2)
            ->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->count();

        $pollcount = Feedpost::where('type', 3)
            ->whereBetween('created_at', [$this->from_date, $this->to_date])
            ->count();

        $engaged_user = User::whereHas('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->where(function (Builder $query) {
            return $query->has('feedpost')
                ->orHas('feedpostlike')
                ->orHas('feedcomment')
                ->orHas('feedcommentreply');
        })->count() +
        Staff::whereHas('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->where(function (Builder $query) {
            return $query->has('feedpost')
                ->orHas('feedpostlike')
                ->orHas('feedcomment')
                ->orHas('feedcommentreply');
        })->count() +
        Student::whereHas('aparent', fn(Builder $q) =>
            $q->whereHas('logininfos', fn(Builder $q) =>
                $q->whereBetween('created_at', [$this->from_date, $this->to_date])
            )
        )->where(function (Builder $query) {
            return $query->has('feedpost')
                ->orHas('feedpostlike')
                ->orHas('feedcomment')
                ->orHas('feedcommentreply');
        })->count();
        if ($atcive_user != 0 && $engaged_user != 0) {
            $engagement_rate = (($atcive_user / $engaged_user) / $atcive_user) * 100;
        } else {
            $engagement_rate = 0;
        }
        return [$atcive_user, $inatcive_user, $engaged_user, $postcount,
            $achievementcount, $pollcount, $engagement_rate];
    }

    // protected function classleaderboard()
    // {
    //     return Student::withCount([
    //         'feedpost',
    //         'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
    //         'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
    //     ])
    //         ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
    //         ->orderBy('feedpost_count', 'desc')
    //         ->take(3)
    //         ->get();
    // }

    // protected function schoolleaderboard()
    // {
    //     return Student::withCount([
    //         'feedpost',
    //         'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
    //         'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
    //     ])
    //         ->orderBy('feedpost_count', 'desc')
    //         ->take(3)
    //         ->get();
    // }

    protected function classleaderboard()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT')
                    ->where('classmaster_id', $this->classmaster_id);

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount')
            ->take(3);

        $ids_ordered = implode(',', $gamificationstarsequence->pluck('gamificationable_id')->toArray());
        if ($ids_ordered) {
            return Student::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
                ->withCount([
                    'feedpost',
                    'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
                    'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
                ])
                ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();
        } else {
            return [];
        }

    }

    protected function schoolleaderboard()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT');

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount')
            ->take(3);

        $ids_ordered = implode(',', $gamificationstarsequence->pluck('gamificationable_id')->toArray());
        if ($ids_ordered) {
            return Student::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
                ->withCount([
                    'feedpost',
                    'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
                    'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
                ])
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();
        } else {
            return [];
        }

    }

    public function openinactiveusermodal()
    {
        $this->showinactiveuserrightnav = true;
    }

    public function closeinactiveusermodal()
    {
        $this->showinactiveuserrightnav = false;
    }

    public function openclassleaderboardmodal()
    {

        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT')
                    ->where('classmaster_id', $this->classmaster_id);

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount');

        $ids_ordered = implode(',', $gamificationstarsequence->pluck('gamificationable_id')->toArray());
        if ($ids_ordered) {
            $this->classleaderboardallstudent = Student::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
                ->withCount([
                    'feedpost',
                    'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
                    'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
                ])
                ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();

        } else {
            return $this->classleaderboardallstudent = [];
        }

        $this->classleaderboardrightnav = true;
    }

    public function closeclassleaderboardmodal()
    {
        $this->classleaderboardallstudent = [];
        $this->classleaderboardrightnav = false;
    }

    public function openschoolleaderboardmodal()
    {
        $gamificationstarsequence = Gamification::whereHasMorph('gamificationable',
            [Student::class],
            function (Builder $query, $type) {
                $column = $type === Student::class ? 'classmaster_id' : 'id';
                $query->where('usertype', 'STUDENT');

            })
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')
            ->get()
            ->sortByDesc('starcount');

        $ids_ordered = implode(',', $gamificationstarsequence->pluck('gamificationable_id')->toArray());
        if ($ids_ordered) {
            $this->schoolleaderboardallstudent = Student::whereIn('id', $gamificationstarsequence->pluck('gamificationable_id'))
                ->withCount([
                    'feedpost',
                    'feedpost as post_count' => fn(Builder $query) => $query->where('type', 1),
                    'feedpost as poll_count' => fn(Builder $query) => $query->where('type', 3),
                ])
                ->orderByRaw("FIELD(id, $ids_ordered)")
                ->get();
        } else {
            return $this->schoolleaderboardallstudent = [];
        }

        $this->schoolleaderboardrightnav = true;
    }

    public function closeschoolleaderboardmodal()
    {
        $this->schoolleaderboardallstudent = [];
        $this->schoolleaderboardrightnav = false;
    }

    public function inactiveuserlist()
    {
        $inatcive_userlist = User::whereDoesntHave('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->get();
        $inatcive_stafflist = Staff::whereDoesntHave('logininfos', fn(Builder $q) =>
            $q->whereBetween('created_at', [$this->from_date, $this->to_date])
        )->get();
        $inatcive_studentlist = Student::whereHas('aparent', fn(Builder $q) =>
            $q->whereDoesntHave('logininfos', fn(Builder $q) =>
                $q->whereBetween('created_at', [$this->from_date, $this->to_date])
            )
        )->get();
        return [$inatcive_userlist, $inatcive_stafflist, $inatcive_studentlist];
    }

    public function render()
    {
        $data = $this->countdetails();
        $classleaderboard = $this->classleaderboard();
        $schoolleaderboard = $this->schoolleaderboard();
        $inactiveuserlist = $this->inactiveuserlist();

        return view('livewire.admin.dashboard.schooltalkzdashboardlivewire',
            ['data' => $data,
                'classleaderboard' => $classleaderboard,
                'schoolleaderboard' => $schoolleaderboard,
                'inactiveuserlist' => $inactiveuserlist,
            ]);
    }
}
