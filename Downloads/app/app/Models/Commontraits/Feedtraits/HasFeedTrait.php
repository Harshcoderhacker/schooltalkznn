<?php

namespace App\Models\Commontraits\Feedtraits;

use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Admin\Feeds\Feedpollcount;
use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Admin\Feeds\Feedreportedpivot;
use App\Models\Admin\Feeds\Feedtag;

trait HasFeedTrait
{
    public function feedpost()
    {
        return $this->morphMany(Feedpost::class, 'feedpostable');
    }

    public function feedpollcount()
    {
        return $this->morphMany(Feedpollcount::class, 'feedpollcountable');
    }
    // Attach
    public function feedpoll()
    {
        return $this->belongsToMany(Feedpost::class, 'feedpollcounts', 'feedpollcountable_id')->withTimestamps();
    }

    public function feedcomment()
    {
        return $this->morphMany(Feedcomment::class, 'feedcommentable');
    }

    public function feedcommentreply()
    {
        return $this->morphMany(Feedcommentreply::class, 'feedcommentreplyable');
    }

    public function feedpostlike()
    {
        return $this->morphMany(Feedpostlike::class, 'feedpostlikeable');
    }
    // Attach or Detach
    public function likedpost()
    {
        return $this->belongsToMany(Feedpost::class, 'feedpostlikes', 'feedpostlikeable_id')->withTimestamps();
    }

    public function feedtag()
    {
        return $this->morphMany(Feedtag::class, 'feedtagable');
    }

    // Attach or Detach
    public function taggedpost()
    {
        return $this->belongsToMany(Feedpost::class, 'feedposttagpivots', 'feedtagable_id')->withTimestamps();
    }

    public function feedreportedpivot()
    {
        return $this->morphMany(Feedreportedpivot::class, 'feedreportedpivotable');
    }

    public function feedachievement()
    {
        return $this->morphMany(Feedpost::class, 'feedpostable')->where('type', 2);
    }
}
