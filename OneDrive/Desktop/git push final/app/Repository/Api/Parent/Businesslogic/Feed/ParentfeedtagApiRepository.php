<?php

namespace App\Repository\Api\Parent\Businesslogic\Feed;

use App\Http\Resources\Parent\Feed\Feedtag\Feedtagpost\ParentfeedtagpostCollection;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedtag;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedtagApiRepository;
use Illuminate\Database\Eloquent\Builder;

class ParentfeedtagApiRepository implements IParentfeedtagApiRepository
{
    public function parentgethashtaglist()
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
            'parentgethashtaglist'];
    }

    public function parentsearchhashtag()
    {
        return [true,
            Feedtag::where('active', true)
                ->select('name', 'uuid')
                ->where('name', 'like', '%' . request('hashtagsearch') . '%')
                ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                ->take(5)
                ->get(),
            'parentsearchhashtag'];
    }

    public function parentgetfeedpostbyhashtaguuid()
    {
        return [true,
            new ParentfeedtagpostCollection(
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
            'parentgetfeedpostbyhashtaguuid'];
    }
}
