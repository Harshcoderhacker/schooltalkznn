<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedreported\Feedreportedpostbyuuid\FeedreportedpostbyuuidCollection;
use App\Http\Resources\Admin\Feed\Feedreported\Feedreportedpost\FeedreportedpostCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedreportedApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;

class AdminfeedreportedApiRepository implements IAdminfeedreportedApiRepository
{
    public function admingetallfeedreportedpost()
    {
        return [true,
            new FeedreportedpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                    'feedpollcount',
                    'feedreportedpivot',
                ])
                    ->with('feedpoll')
                    ->where('active', true)
                    ->where('reported_stage', 2)
                    ->where('is_notstike', true)
                    ->latest()
                    ->paginate(15)
            ),
            'admingetallfeedreportedpost'];

    }

    public function admingetallreportedbypostuuid()
    {
        return [true,
            new FeedreportedpostbyuuidCollection(
                Feedpost::find(
                    Feedpost::where('uuid', request('feedpostuuid'))
                        ->first()
                        ->id
                )
                    ->feedreportedpivot()
                    ->with('feedreportedpivotable')
                    ->paginate(15)
            ),
            'admingetallreportedbypostuuid'];
    }

    public function adminfeedreportedpoststatusupdate()
    {

        $feedpost = Feedpost::where('uuid', request('feedpostuuid'))->first();
        $feedpost->update(['reported_stage' => request('reported_status') ? 3 : 4]);

        if (request('reported_status') == 4) {
            foreach ($feedpost->feedcomment as $eachfeedcomment) {
                Gamificationfeedhelper::gamificationfeedengagepeercomment($eachfeedcomment->feedcommentable);
            }
            foreach ($feedpost->feedpostlike as $eachfeedpostlike) {
                Gamificationfeedhelper::gamificationfeedengagepeerlike($eachfeedpostlike->feedpostlikeable);
            }
            $feedpost->gamefunctionable()->delete();
        }

        Helper::trackmessage(auth()->user(), 'Admin Feed Reported Post Status Update ', 'admin_api_adminfeedreportedpoststatusupdate', substr(request()->header('authorization'), -33), 'API');

        DB::commit();
        return [true, 'adminfeedreportedpoststatusupdate'];

    }
}
