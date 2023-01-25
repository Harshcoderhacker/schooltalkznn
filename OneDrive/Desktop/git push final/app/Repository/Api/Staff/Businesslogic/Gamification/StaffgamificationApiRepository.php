<?php

namespace App\Repository\Api\Staff\Businesslogic\Gamification;

use App\Http\Resources\Staff\Gamification\StaffgamificationmonthResource;
use App\Http\Resources\Staff\Gamification\StaffgamificationoverallResource;
use App\Models\Staff\Auth\Staff;
use App\Repository\Api\Staff\Interfacelayer\Gamification\IStaffgamificationApiRepository;

class StaffgamificationApiRepository implements IStaffgamificationApiRepository
{

    public function staffgamificationinfo()
    {
        return [
            true,
            config('gamificationarchive.staff_gamification_api'),
            'staffgamificationinfo'
        ];
    }

    public function staffgamificationgoal()
    {

        $gamification = auth()->user()->gamificationable;
        $feedpost = $this->feedpost($gamification);
        $data = (env('FEEDPOST') == 1) ? array_merge($feedpost, $this->schooloperation($gamification)) : $feedpost;
        return [true, ['mystar' => $gamification->sum('star'), 'goals' => $data], 'staffgamificationgoal'];
    }

    public function staffgamificationleaderborad()
    {

        $allstaffthismonth = Staff::withSum(['gamificationable' => function ($query) {
            $query->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'));
        }], 'star')
            ->orderBy('gamificationable_sum_star', 'desc')
            ->get()
            ->take(3)
            ->filter(function ($post) {
                return $post->gamificationable_sum_star > 0;
            });

        $staffthismonth = auth()->user()
            ->withSum(['gamificationable' => function ($query) {
                $query->whereMonth('created_at', date('m'))
                    ->whereYear('created_at', date('Y'));
            }], 'star')
            ->where('id', auth()->user()->id)
            ->orderBy('gamificationable_sum_star', 'desc')
            ->first();

        $allstaffoverall = Staff::withSum('gamificationable', 'star')
            ->orderBy('gamificationable_sum_star', 'desc')
            ->get()
            ->take(3)
            ->filter(function ($post) {
                return $post->gamificationable_sum_star > 0;
            });

        $staffoverall = auth()->user()
            ->withSum('gamificationable', 'star')
            ->where('id', auth()->user()->id)
            ->first();

        return [
            true,
            [
                'thismonth' => [
                    'first_three_staff' => StaffgamificationmonthResource::collection($allstaffthismonth),
                    'your_position' => new StaffgamificationmonthResource($staffthismonth),
                ],
                'overall' => [
                    'first_three_staff' => StaffgamificationoverallResource::collection($allstaffoverall),
                    'your_position' => new StaffgamificationoverallResource($staffoverall),
                ],
            ],
            'staffgamificationleaderborad'
        ];
    }

    protected function feedpost($gamification)
    {
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
                'name' => 'Engage with your peers 5 likes',
                'value' => $gamification->where('subtype', 4)->sum('star') . ' Star',
            ],
            [
                'name' => 'Engage with your peers 2 comments',
                'value' => $gamification->where('subtype', 5)->sum('star') . ' Star',
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
            [
                'name' => 'Finish all Classes in time (weekly)',
                'value' => $gamification->where('subtype', 9)->sum('star') . ' Star',
            ],
            [
                'name' => 'Create one assessment (daily)',
                'value' => $gamification->where('subtype', 10)->sum('star') . ' Star',
            ],
            [
                'name' => 'Create one homework (daily)',
                'value' => $gamification->where('subtype', 11)->sum('star') . ' Star',
            ],
            [
                'name' => 'Take Daily Attendance',
                'value' => $gamification->where('subtype', 12)->sum('star') . ' Star',
            ],
            [
                'name' => 'Converse in your class group (1 chat) (daily)',
                'value' => $gamification->where('subtype', 13)->sum('star') . ' Star',
            ],
        ];
    }
}
