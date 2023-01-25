<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpollcount;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpollApiRepository;
use DB;

class StafffeedpollApiRepository implements IStafffeedpollApiRepository
{
    public function stafffeedpolltoggle()
    {
        $user = auth()->user();

        $feedpoll = Feedpoll::where('uuid', request('feedpolluuid'))
            ->first();

        if ($user->feedpollcount->where('feedpost_id', $feedpoll->feedpost_id)->count() == 0) {
            $user->feedpollcount()
                ->save(new Feedpollcount([
                    'feedpost_id' => $feedpoll->feedpost_id,
                    'feedpoll_id' => $feedpoll->id,
                ]));

            $feedpoll->pollcount += 1;
            $feedpoll->save();

            $allpoll = Feedpoll::where('feedpost_id', $feedpoll->feedpost_id)
                ->get();

            $totalcount = $allpoll->sum('pollcount');

            foreach ($allpoll as $eachpoll) {
                $currentpoll = Feedpoll::find($eachpoll->id);
                $currentpoll->percentage = round(($currentpoll->pollcount / $totalcount) * 100);
                $currentpoll->save();
            }

        } else {
            DB::rollback();
            return [true, ['data' => 'Already Voted'], 'stafffeedpolltoggle'];
        }

        Helper::trackmessage($user,
            'Staff Feed Poll Vote ',
            'staff_api_stafffeedpolltoggle',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();
        return [true, ['data' => 'Voted'], 'stafffeedpolltoggle'];
    }
}
