<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Staff\Feed\Feedcomment\StafffeedcommentCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostcommentApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class StafffeedpostcommentApiRepository implements IStafffeedpostcommentApiRepository
{
    public function staffcreatefeedpostcomment()
    {
        $user = auth()->user();

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();

        $user->feedcomment()
            ->save(new Feedcomment([
                'feedpost_id' => $feedpost->id,
                'comment' => request('feedcomment'),
                'commenttype' => request('commenttype'),
                'commenttype_uuid' => request('commenttype_uuid'),
            ]));

        Gamificationfeedhelper::gamificationfeedcomment($feedpost, 'create');
        $modulo = Gamificationfeedhelper::gamificationfeedengagepeercomment($user);
        $reward_popup = ($modulo == 0) ? 'You Have Earned ' . config('gamificationarchive.staff_gamification')[5] . ' Stars' : false;

        Helper::trackmessage($user, 'Staff Feed Post Comment Create ', 'staff_api_staffcreatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');

        DB::commit();
        return [true, ['reward_popup' => $reward_popup, 'star_count' => 'Total Star : ' . $user->gamificationable->sum('star')], 'staffcreatefeedpostcomment'];
    }

    public function staffupdatefeedpostcomment()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();
        $user = auth()->user();
        if ($feedcomment->feedcommentable->uuid == $user->uuid) {
            $feedcomment->update([
                'comment' => request('feedcomment'),
                'commenttype' => request('commenttype'),
                'commenttype_uuid' => request('commenttype_uuid'),
            ]);

            Helper::trackmessage($user, 'Staff Feed Post Comment Update ', 'staff_api_staffupdatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');

            DB::commit();
            return [true, 'staffupdatefeedpostcomment'];
        } else {
            DB::rollback();
            return [false, 'staffupdatefeedpostcomment'];
        }
    }

    public function staffgetallcommentbypostuuid()
    {
        return [true,
            new StafffeedcommentCollection(
                Feedcomment::where('feedpost_id',
                    Feedpost::where('uuid', request('feedpostuuid'))
                        ->first()
                        ->id
                )
                    ->where('active', true)
                    ->withCount(['feedcommentreply' => fn(Builder $query) => $query->where('is_notstike', true)->where('active', true)])
                    ->oldest()
                    ->paginate(15)
            ),
            'staffgetallcommentbypostuuid'];
    }

    public function stafffeedpostcommentstatusupdate()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();
        $user = auth()->user();

        if ($feedcomment->feedcommentable->uuid == $user->uuid) {
            $feedcomment->update([
                'active' => request('active'),
            ]);

            Helper::trackmessage($user, 'Staff Feed Post Comment Status Update ',
                'staff_api_stafffeedpostcommentstatusupdate',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'stafffeedpostcommentstatusupdate'];
        } else {
            DB::rollback();
            return [false, 'stafffeedpostcommentstatusupdate'];
        }
    }

    public function staffdeletefeedpostcomment()
    {
        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))->first();
        $user = auth()->user();

        if ($feedcomment->feedcommentable->uuid == $user->uuid) {

            Gamificationfeedhelper::gamificationfeedcomment(
                Feedpost::whereHas('feedcomment',
                    fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))
                    ->first(), 'delete'
            );
            Gamificationfeedhelper::gamificationfeedengagepeercomment($user);

            $feedcomment->delete();

            Helper::trackmessage($user, 'Staff Feed Post Comment Delete ', 'staff_api_staffdeletefeedpostcomment', substr(request()->header('authorization'), -33), 'API');
            DB::commit();
            return [true, 'staffdeletefeedpostcomment'];
        } else {
            DB::rollback();
            return [false, 'staffdeletefeedpostcomment'];
        }
    }
}
