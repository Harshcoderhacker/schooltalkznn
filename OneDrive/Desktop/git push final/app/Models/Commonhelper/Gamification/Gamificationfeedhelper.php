<?php

namespace App\Models\Commonhelper\Gamification;

use App\Models\Admin\Feeds\Feedpostlike;
use Illuminate\Database\Eloquent\Model;

class Gamificationfeedhelper extends Model
{

    public static function gamificationfeedpost($user, $feedpost, $type)
    {

        if ($feedpost->idealibable) {

            $user->gamificationable()
                ->make([
                    'maintype' => 1,
                    'subtype' => 999, // 999- idea library post
                    'star' => $feedpost->idealibable->starvalue,
                ])
                ->gamefunctionable()
                ->associate($feedpost)
                ->save();

        } else if ($user->feedpost->where('type', $type)->whereNull('idealibable_id')->count() <= 10) {

            $user->gamificationable()
                ->make([
                    'maintype' => 1,
                    'subtype' => $type,
                    'star' => config('gamificationarchive.student_gamification')[$type],
                ])
                ->gamefunctionable()
                ->associate($feedpost)
                ->save();

        }
    }

    // 'Get your post cross 5 likes'
    public static function gamificationfeedlike($feedpost)
    {

        $feedpostlikecount = Feedpostlike::where('feedpost_id', $feedpost->id)->count();
        $user = $feedpost->feedpostable;

        if ($feedpostlikecount == 5 && ($user->usertype == 'STUDENT' || $user->usertype == 'STAFF')) {
            $user->gamificationable()
                ->make([
                    'maintype' => 1,
                    'subtype' => ($user->usertype == 'STUDENT') ? 6 : 6,
                    'star' => ($user->usertype == 'STUDENT') ? config('gamificationarchive.student_gamification')[6] : config('gamificationarchive.staff_gamification')[6],
                ])
                ->gamefunctionable()
                ->associate($feedpost)
                ->save();

        } else if ($feedpostlikecount < 5) {
            $feedpost->gamefunctionable()
                ->where('subtype', 6)
                ->delete();
        }
    }

    // 'Get your post cross 2 comments'
    public static function gamificationfeedcomment($feedpost, $type)
    {
        $feedpostuser = $feedpost->feedpostable;

        $feedcommentcount = $feedpost->feedcomment()
            ->whereRelation('feedcommentable', 'uuid', '<>', $feedpost->feedpostable->uuid)
            ->count();

        if ($type == 'create' && $feedcommentcount == 2 && ($feedpostuser->usertype == 'STUDENT' || $feedpostuser->usertype == 'STAFF')) {
            if ($feedpost->gamefunctionable->where('subtype', 7)->count() == 0) {
                $feedpostuser->gamificationable()
                    ->make([
                        'maintype' => 1,
                        'subtype' => ($feedpostuser->usertype == 'STUDENT') ? 7 : 7,
                        'star' => ($feedpostuser->usertype == 'STUDENT') ? config('gamificationarchive.student_gamification')[7] : config('gamificationarchive.staff_gamification')[7],
                    ])
                    ->gamefunctionable()
                    ->associate($feedpost)
                    ->save();
            }
        } else if ($type == 'delete' && $feedcommentcount == 2) {
            $feedpost->gamefunctionable()
                ->where('subtype', 7)
                ->delete();
        }
    }

    // 'Engage with your peers (5 likes)'
    protected static function gamificationfeedengagepeerlike($user)
    {
        if ($user->usertype == 'STUDENT' || $user->usertype == 'STAFF') {
            $feedpostlikecount = $user->feedpostlike()
                ->whereRelation('feedpost.feedpostable', 'uuid', '<>', $user->uuid)
                ->count();

            $starcount = (floor($feedpostlikecount / 5) *
                (($user->usertype == 'STUDENT') ? config('gamificationarchive.student_gamification')[4] : config('gamificationarchive.staff_gamification')[4]));

            $gamificationable = $user->gamificationable()
                ->where('subtype', 4)
                ->first();

            if ($gamificationable) {
                $gamificationable->star = $starcount;
                $gamificationable->save();
            } else {
                $user->gamificationable()
                    ->create([
                        'maintype' => 1,
                        'subtype' => ($user->usertype == 'STUDENT') ? 4 : 4,
                        'star' => $starcount,
                    ]);
            }

            return fmod($feedpostlikecount, 5);
        }
    }

    // 'Engage with your peers (2 comments)'
    public static function gamificationfeedengagepeercomment($user)
    {
        if ($user->usertype == 'STUDENT' || $user->usertype == 'STAFF') {
            $feedcommentcount = $user->feedcomment()
                ->whereRelation('feedpost.feedpostable', 'uuid', '<>', $user->uuid)
                ->count();

            $starcount = (floor($feedcommentcount / 2) *
                (($user->usertype == 'STUDENT') ? config('gamificationarchive.student_gamification')[5] : config('gamificationarchive.staff_gamification')[5]));

            $gamificationable = $user->gamificationable()
                ->where('subtype', 5)
                ->first();

            if ($gamificationable) {
                $gamificationable->star = $starcount;
                $gamificationable->save();
            } else {
                $user->gamificationable()
                    ->create([
                        'maintype' => 1,
                        'subtype' => ($user->usertype == 'STUDENT') ? 5 : 5,
                        'star' => $starcount,
                    ]);
            }

            return fmod($feedcommentcount, 2);
        }
    }

}
