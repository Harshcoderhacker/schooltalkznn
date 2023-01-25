<?php

namespace App\Http\Livewire\Admin\Feed;

use App\Models\Admin\Feeds\Feedtag;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Adminfeedhashtaglivewire extends Component
{
    public function render()
    {

        $hasttag = array_merge(
            Feedtag::where('active', true)
                ->select('name', 'uuid')
                ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                ->whereHas('feedtagable', fn(Builder $query) => $query->where('usertype', '<>', 'ADMIN'))
                ->orderBy('feedpost_count', 'desc')
                ->take(5)
                ->get()
                ->toArray(),

            Feedtag::where('active', true)
                ->select('name', 'uuid')
                ->withCount(['feedpost' => fn(Builder $query) => $query->where('active', true)])
                ->whereHas('feedtagable', fn(Builder $query) => $query->where('usertype', 'ADMIN'))
                ->latest()
                ->take(5)
                ->get()
                ->toArray()
        );

        return view('livewire.admin.feed.adminfeedhashtaglivewire', compact('hasttag'));
    }
}
