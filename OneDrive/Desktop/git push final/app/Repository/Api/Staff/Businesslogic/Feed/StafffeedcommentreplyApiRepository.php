<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Staff\Feed\Feedcommentreply\StafffeedcommentreplyCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Staff\Businesslogic\Feed\StafffeedcommentreplyApiRepository;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedcommentreplyApiRepository;
use DB;
use Illuminate\Database\Eloquent\Builder;

class StafffeedcommentreplyApiRepository implements IStafffeedcommentreplyApiRepository
{
    public function staffcreatefeedpostcommentreply()
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

        Helper::trackmessage($user, 'Staff Feed Post Create ', 'staff_api_staffcreatefeedpostcommentreply', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'staffcreatefeedpostcommentreply'];
    }

    public function staffgetcommentreplybycommentuuid()
    {

        return [true,
            new StafffeedcommentreplyCollection(
                Feedcommentreply::whereHas('feedcomment', fn(Builder $q) => $q->where('uuid', request('feedcommentuuid')))

                    ->where('is_notstike', true)
                    ->where('active', true)
                    ->latest()
                    ->paginate(15)
            ),
            'staffgetcommentreplybycommentuuid'];
    }
    public function staffcommentreplyupdatebyuuid()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();

        $user = auth()->user();

        if ($feedcommentreply->feedcommentreplyable->uuid == $user->uuid) {
            $feedcommentreply->update([
                'reply' => request('reply'),
            ]);

            Helper::trackmessage($user, 'Staff Feed Post Create ', 'staff_api_staffcommentreplyupdatebyuuid',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'staffcommentreplyupdatebyuuid'];
        } else {
            DB::rollback();
            return [false, 'staffcommentreplyupdatebyuuid'];
        }
    }

    public function staffcommentreplystatusupdate()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();

        if ($feedcommentreply->feedcommentreplyable->id == auth()->user()->id) {
            $feedcommentreply->update([
                'active' => request('active'),
            ]);

            Helper::trackmessage(auth()->user(), 'Staff Feed Post Create ', 'staff_api_staffcommentreplystatusupdate',
                substr(request()->header('authorization'), -33),
                'API');
            DB::commit();
            return [true, 'staffcommentreplystatusupdate'];
        } else {
            DB::rollback();
            return [false, 'staffcommentreplystatusupdate'];
        }
    }

    public function staffcommentreplydelete()
    {
        $feedcommentreply = Feedcommentreply::where('uuid', request('feedcommentreplyuuid'))->first();
        $user = auth()->user();

        if ($feedcommentreply->feedcommentreplyable->uuid == $user->uuid) {
            $feedcommentreply->delete();

            Helper::trackmessage($user, 'Staff Feed Post Create ', 'staff_api_staffcommentreplydelete',
                substr(request()->header('authorization'), -33),
                'API');

            DB::commit();
            return [true, 'staffcommentreplydelete'];
        } else {
            DB::rollback();
            return [false, 'staffcommentreplydelete'];
        }
    }
}
