<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpollcount;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Parenthelper\Parenthelper;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpollApiRepository;
use DB;

class ParentfeedpollApiRepository implements IParentfeedpollApiRepository
{
    public function parentfeedpolltoggle()
    {
        $student = Parenthelper::getstudent();

        $feedpoll = Feedpoll::where('uuid', request('feedpolluuid'))
            ->first();

        if ($student->feedpollcount->where('feedpost_id', $feedpoll->feedpost_id)->count() == 0) {
            $student->feedpollcount()
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
            return [true, ['data' => 'Already Voted'], 'parentfeedpolltoggle'];
        }

        Helper::trackmessage(auth()->user(),
            'parent Feed Poll Vote ',
            'parent_api_parentfeedpolltoggle',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();
        return [true, ['data' => 'Voted'], 'parentfeedpolltoggle'];
    }
}
