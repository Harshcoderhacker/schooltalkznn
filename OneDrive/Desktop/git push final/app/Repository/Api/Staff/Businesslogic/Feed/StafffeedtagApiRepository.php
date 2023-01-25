<?php

namespace App\Repository\Api\Staff\Businesslogic\Feed;

use App\Http\Resources\Staff\Feed\Feedtag\Feedtagpost\StafffeedtagpostCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedtagApiRepository;
use Illuminate\Database\Eloquent\Builder;

class StafffeedtagApiRepository implements IStafffeedtagApiRepository
{
    public function staffgethashtaglist()
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
            'staffgethashtaglist'];
    }

    public function staffsearchhashtag()
    {
        return [true,
            Feedtag::where('active', true)
                ->select('name', 'uuid')
                ->where('name', 'like', '%' . request('hashtagsearch') . '%')
                ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                ->take(5)
                ->get(),
            'staffsearchhashtag'];
    }

    public function staffgetfeedpostbyhashtaguuid()
    {
        return [true,
            new StafffeedtagpostCollection(
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
            'staffgetfeedpostbyhashtaguuid'];
    }
}
