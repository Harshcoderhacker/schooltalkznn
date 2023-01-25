<?php

namespace App\Repository\Api\Admin\Businesslogic\Feed;

use App\Http\Resources\Admin\Feed\Feedtag\Feedtagpost\FeedtagpostCollection;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Miscellaneous\Helper;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedtagApiRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class AdminfeedtagApiRepository implements IAdminfeedtagApiRepository
{
    public function admingethashtaglist()
    {
        return [true,
            array_merge(
                Feedtag::where('active', true)
                    ->select('name', 'uuid')
                    ->where('name', '<>', "")
                    ->whereNotNull('name')
                    ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                    ->whereHas('feedtagable', fn(Builder $query) => $query->where('usertype', '<>', 'ADMIN'))
                    ->orderBy('feedpost_count', 'desc')
                    ->take(5)
                    ->get()
                    ->toArray(),

                Feedtag::where('active', true)
                    ->select('name', 'uuid')
                    ->where('name', '<>', "")
                    ->whereNotNull('name')
                    ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                    ->whereHas('feedtagable', fn(Builder $query) => $query->where('usertype', 'ADMIN'))
                    ->latest()
                    ->take(5)
                    ->get()
                    ->toArray()
            ),
            'admingetallhashtag'];
    }

    public function adminsearchhashtag()
    {
        return [true,
            Feedtag::where('active', true)
                ->select('name', 'uuid')
                ->where('name', 'like', '%' . request('hashtagsearch') . '%')
                ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                ->take(5)
                ->get(),
            'admingetallhashtag'];
    }

    public function admingetfeedpostbyhashtaguuid()
    {
        return [true,
            new FeedtagpostCollection(
                Feedpost::withCount([
                    'feedpostlike' => fn(Builder $query) => $query->where('active', true),
                    'feedcomment' => fn(Builder $query) => $query->where('active', true),
                ])
                    ->whereHas('feedtag', fn(Builder $query) => $query->where('uuid', request('hashtaguuid')))
                    ->with('feedpoll', 'feedtag')
                    ->where('active', true)
                    ->where('reported_stage', '<>', 4)
                    ->where('is_notstike', true)
                    ->latest()
                    ->paginate(15)
            ),
            'admingetallhashtag'];
    }

    // Not used yet
    public function adminhashtagstatusupdate()
    {
        Feedtag::where('uuid', request('hashtaguuid'))
            ->update([
                'active' => request('active'),
            ]);

        Helper::trackmessage(auth()->user(), 'Admin Feed Hashtag Status Update ',
            'admin_api_adminhashtagstatusupdate',
            substr(request()->header('authorization'), -33),
            'API');

        DB::commit();

        return [true, 'test', 'adminhashtagstatusupdate'];
    }

    // Not used yet
    public function adminhashtagdelete()
    {
        Feedcomment::where('uuid', request('hashtaguuid'))->delete();

        Helper::trackmessage(auth()->user(), 'Admin Feed Hashtag Delete ', 'admin_api_adminhashtagdelete', substr(request()->header('authorization'), -33), 'API');
        DB::commit();
        return [true, 'test', 'adminhashtagdelete'];
    }
}
