<?php

namespace App\Repository\Api\Parent\Businesslogic\Gamification;

use App\Http\Resources\Parent\Gamification\ParentgamificationoverallResource;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Gamification\IParentgamificationApiRepository;
use Illuminate\Database\Eloquent\Builder;

class ParentgamificationApiRepository implements IParentgamificationApiRepository
{

    public function parentgamificationinfo()
    {
        return [
            true,
            config('gamificationarchive.student_gamification_api'),
            'parentgamificationinfo'
        ];
    }

    public function parentgamificationgoal()
    {
        $gamification = Parenthelper::getstudent()->gamificationable;
        $feedpost = $this->feedpost($gamification);
        $data = (env('FEEDPOST') == 1) ? array_merge($feedpost, $this->schooloperation($gamification)) : $feedpost;
        return [true, ['mystar' => $gamification->sum('star'), 'goals' => $data], 'parentgamificationgoal'];
    }

    public function parentgamificationleaderborad()
    {

        $student = Parenthelper::getstudent();

        $classmaster_id = $student->classmaster_id;
        $allstudentthismonthdata = Gamification::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->whereHasMorph(
                'gamificationable',
                [Student::class],
                function (Builder $query, $type) use ($classmaster_id) {
                    $column = $type === Student::class ? 'classmaster_id' : 'id';
                    $query->where('usertype', 'STUDENT')
                        ->where($column, $classmaster_id);
                }
            )
            ->groupBy('gamificationable_id')
            ->selectRaw('sum(star) as starcount, gamificationable_id')->get();

        $allstudentthismonthdata = $allstudentthismonthdata->sortByDesc('starcount');

        $allstudentthismonth = collect();
        $i = 1;
        foreach ($allstudentthismonthdata->take(3) as $key => $value) {
            $studentdata = Student::find($value->gamificationable_id);
            $arr['name'] = $studentdata->name ? $studentdata->name : '';
            $arr['avatar'] = $studentdata->avatar ? $studentdata->avatar : '';
            $arr['star'] = $value->starcount;
            $arr['rank'] = $i++;
            $allstudentthismonth->push($arr);
        }

        $i = 1;
        $studentthismonth = [];
        $star = null;
        $rank = null;
        foreach ($allstudentthismonthdata as $key => $value) {
            $star = ($student->id == $value->gamificationable_id) ? $value->starcount : '-';
            $rank = ($student->id == $value->gamificationable_id) ? $i : '-';
            $i++;
        }

        $studentthismonth['name'] = $student->name ? $student->name : '';
        $studentthismonth['avatar'] = $student->avatar ? $student->avatar : '';
        $studentthismonth['star'] = $star;
        $studentthismonth['rank'] = $rank;

        // $studentthismonth = $student->withSum('gamificationable', 'star', fn(Builder $q) =>
        //     $q->whereMonth('created_at', date('m'))
        //         ->whereYear('created_at', date('Y'))
        // )
        //     ->where('id', $student->id)
        //     ->orderBy('gamificationable_sum_star', 'desc')
        //     ->first();

        $allstudentoverall = Student::where('classmaster_id', $student->classmaster_id)
            ->withSum('gamificationable', 'star')
            ->orderBy('gamificationable_sum_star', 'desc')
            ->get()
            ->take(3)
            ->filter(function ($post) {
                return $post->gamificationable_sum_star > 0;
            });

        $studentoverall = $student->withSum('gamificationable', 'star')->where('id', $student->id)->first();

        return [
            true,
            [
                'thismonth' => [
                    'first_three_student' => $allstudentthismonth,
                    'your_position' => $studentthismonth,
                ],
                'overall' => [
                    'first_three_student' => ParentgamificationoverallResource::collection($allstudentoverall),
                    'your_position' => new ParentgamificationoverallResource($studentoverall),
                ],
            ],
            'parentgamificationleaderborad'
        ];
    }

    protected function feedpost($gamification)
    {

        $peerlikecount = $gamification->where('subtype', 4)->first()?->star;
        $peercommentcount = $gamification->where('subtype', 5)->first()?->star;

        return [
            [
                'name' => 'Create a Inspirations',
                'value' => $gamification->where('subtype', 999)->sum('star') . ' Star',
            ],
            [
                'name' => 'Create a Post',
                'value' => $gamification->where('subtype', 1)->sum('star') . ' Star',
            ],
            [
                'name' => 'Create an achievement',
                'value' => $gamification->where('subtype', 2)->sum('star') . ' Star',
            ],
            [
                'name' => 'Create a poll',
                'value' => $gamification->where('subtype', 3)->sum('star') . ' Star',
            ],
            [
                'name' => 'Engage with your peers 5 likes ',
                'value' => ($peerlikecount ? $peerlikecount : 0) . ' Star',
            ],
            [
                'name' => 'Engage with your peers 2 comments',
                'value' => ($peercommentcount ? $peercommentcount : 0) . ' Star',
            ],
            [
                'name' => 'Get your post cross 5 likes',
                'value' => $gamification->where('subtype', 6)->sum('star') . ' Star',
            ],
            // [
            //     'name' => 'Get your post cross 2 comments',
            //     'value' => $gamification->where('subtype', 7)->sum('star') . ' Star',
            // ],
        ];
    }

    protected function schooloperation($gamification)
    {
        return [
            // [
            //     'name' => 'Get 100% attendance in 2 weeks',
            //     'value' => $gamification->where('subtype', 8)->sum('star') . ' Star',
            // ],
            // [
            //     'name' => 'Score 90% above in all daily assesments',
            //     'value' => $gamification->where('subtype', 9)->sum('star') . ' Star',
            // ],
            // [
            //     'name' => 'Score 100% in all assesments',
            //     'value' => $gamification->where('subtype', 10)->sum('star') . ' Star',
            // ],
            // [
            //     'name' => 'Finish all homeworks',
            //     'value' => $gamification->where('subtype', 11)->sum('star') . ' Star',
            // ],
            // [
            //     'name' => 'Converse in your class group (1 chat)',
            //     'value' => $gamification->where('subtype', 12)->sum('star') . ' Star',
            // ],
        ];
    }
}
