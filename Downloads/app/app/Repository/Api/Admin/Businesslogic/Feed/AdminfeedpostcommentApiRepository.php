<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedcomment\FeedcommentCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Commonhelper\Gamification\Gamificationfeedhelper;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostcommentApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdminfeedpostcommentApiRepository implements IAdminfeedpostcommentApiRepository
{
    public function admincreatefeedpostcomment()
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

        Helper::trackmessage($user, 'Admin Feed Post Comment Create ', 'admin_api_admincreatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'admincreatefeedpostcomment'];
    }

    public function adminupdatefeedpostcomment()
    {
        Feedcomment::where('uuid', request('feedcommentuuid'))
            ->update([
                'comment' => request('feedcomment'),
                'commenttype' => request('commenttype'),
                'commenttype_uuid' => request('commenttype_uuid'),
            ]);

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Comment Update ', 'admin_api_adminupdatefeedpostcomment', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'adminupdatefeedpostcomment'];
    }

    public function admingetallcommentbypostuuid()
    {
        return [true,
            new FeedcommentCollection(
                Feedcomment::where('feedpost_id', Feedpost::where('uuid', request('feedpostuuid'))->first()->id)
                    ->where('active', true)
                    ->withCount(['feedcommentreply' => fn(Builder $query) => $query->where('is_notstike', true)->where('active', true)])
                    ->oldest()
                    ->paginate(15)
            ),
            'admingetallcommentbypostuuid'];
    }

    public function adminfeedpostcommentstatusupdate()
    {
        Feedcomment::where('uuid', request('feedcommentuuid'))
            ->update([
                'active' => request('active'),
            ]);
        Helper::trackmessage(auth()->user(), 'Admin Feed Post Comment Status Update ',
            'admin_api_adminfeedpostcommentstatusupdate',
            substr(request()->header('authorization'), -33),
            'API');
        DB::commit();

        return [true, 'adminfeedpostcommentstatusupdate'];
    }

    public function admindeletefeedpostcomment()
    {

        Gamificationfeedhelper::gamificationfeedcomment(
            Feedpost::whereHas('feedcomment',
                fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))
                ->first(), 'delete'
        );

        Feedcomment::where('uuid', request('feedcommentuuid'))->delete();

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Comment Delete ', 'admin_api_admindeletefeedpostcomment', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'admindeletefeedpostcomment'];
    }
}
