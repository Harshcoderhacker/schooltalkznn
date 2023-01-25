<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedcommentreply\FeedcommentreplyCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedcommentreplyApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;

class AdminfeedcommentreplyApiRepository implements IAdminfeedcommentreplyApiRepository
{
    public function admincreatefeedpostcommentreply()
    {
        $user = auth()->user();

        $feedcomment = Feedcomment::where('uuid', request('feedcommentuuid'))
            ->first();

        $user->feedcommentreply()
            ->save(new Feedcommentreply([
                'feedpost_id' => $feedcomment->feedpost_id,
                'feedcomment_id' => $feedcomment->id,
                'reply' => request('reply'),
            ]));

        Helper::trackmessage($user, 'Admin Feed Post Create ', 'admin_api_admincreatefeedpostcommentreply', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'admincreatefeedpostcommentreply'];
    }

    public function admingetcommentreplybycommentuuid()
    {
        return [true,
            new FeedcommentreplyCollection(
                Feedcommentreply::whereHas('feedcomment', fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))
                    ->where('is_notstike', true)
                    ->where('active', true)
                    ->latest()
                    ->paginate(15)
            ),
            'admincreatefeedpostcommentreply'];
    }

    public function admincommentreplyupdatebyuuid()
    {
        Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))
            ->update([
                'reply' => request('reply'),
            ]);

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Create ', 'admin_api_admincommentreplyupdatebyuuid',
            substr(request()->header('authorization'), -33),
            'API');
        DB::commit();
        return [true, 'admincommentreplyupdatebyuuid'];
    }

    public function admincommentreplystatusupdate()
    {
        Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))
            ->update([
                'active' => request('active'),
            ]);

        Helper::trackmessage(auth()->user(), 'Admin Feed Post Create ', 'admin_api_admincommentreplystatusupdate',
            substr(request()->header('authorization'), -33),
            'API');
        DB::commit();
        return [true, 'admincommentreplystatusupdate'];
    }

    public function admincommentreplydelete()
    {
        Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->delete();
        Helper::trackmessage(auth()->user(), 'Admin Feed Post Create ', 'admin_api_admincommentreplydelete',
            substr(request()->header('authorization'), -33),
            'API');
        DB::commit();
        return [true, 'admincommentreplydelete'];
    }
}
