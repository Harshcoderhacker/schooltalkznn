<?php

namespace App\Models\Admin\Feeds;

use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Feedtag extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function feedtagable()
    {
        return $this->morphTo();
    }

    public function feedpost()
    {
        return $this->belongsToMany(Feedpost::class, 'feedposttagpivots');
    }

}
