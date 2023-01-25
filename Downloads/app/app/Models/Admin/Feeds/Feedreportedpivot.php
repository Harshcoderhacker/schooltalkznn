<?php

namespace App\Models\Admin\Feeds;

use App\Models\Admin\Feeds\Feedreported;
use Illuminate\Database\Eloquent\Model;

class Feedreportedpivot extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function feedreportedpivotable()
    {
        return $this->morphTo();
    }

    public function feedreported()
    {
        return $this->belogsToMany(Feedreported::class);
    }
}
