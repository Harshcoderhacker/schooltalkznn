<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedpostlike\FeedpostlikelistCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostlikeApiRepository;
use Illuminate\Support\Facades\DB;

class StafffeedpostlikeApiRepository implements IStafffeedpostlikeApiRepository
{
    public function stafffeedpostliketoggle()
    {
        $reward_popup = false;
        $user = auth()->user();

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();

        $feedpostlikecount = $user->feedpostlike->where('feedpost_id', $feedpost->id)->count();
        if ($feedpostlikecount == 0) {

            $user->feedpostlike()
                ->save(new Feedpostlike([
                    'feedpost_id' => $feedpost->id,
                ]));

            $toggle = 'attach';
        } else {
            $user->feedpostlike()->where('feedpost_id', $feedpost->id)->first()->delete();
            $toggle = 'detach';
        }

        Gamificationfeedhelper::gamificationfeedlike($feedpost);
        $modulo = Gamificationfeedhelper::gamificationfeedengagepeerlike($user);
        $reward_popup = ($modulo == 0 && $toggle == "attach") ? 'You Have Earned ' . config('gamificationarchive.staff_gamification')[4] . ' Stars' : false;

        Helper::trackmessage($user,
            'Staff Feed Post Like ',
            'staff_api_stafffeedpostliketoggle_' . $toggle,
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();
        return [true, ['toggle' => $toggle, 'reward_popup' => $reward_popup, 'star_count' => 'Total Star : ' . $user->gamificationable->sum('star')], 'stafffeedpostliketoggle'];
    }

    public function stafffeedpostlikelist()
    {
        return [true,
            new FeedpostlikelistCollection(
                Feedpost::where('uuid', request('feedpostuuid'))
                    ->first()
                    ->feedpostlike()
                    ->paginate(15)
            ),
            'stafffeedpostlikelist'];
    }

}
