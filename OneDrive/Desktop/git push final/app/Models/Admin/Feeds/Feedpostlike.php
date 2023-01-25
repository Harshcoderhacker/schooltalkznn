<?php

namespace App\Models\Admin\Feeds;

use App\Events\Feedpostevent\NewfeedpostlikeEvent;
use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Feedpostlike extends Model
{

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });

        // Event Feed Post like
        static::created(function ($feedpostlike) {
            event(new NewfeedpostlikeEvent($feedpostlike));
        });
    }

    public function feedpostlikeable()
    {
        return $this->morphTo();
    }

    public function feedpost()
    {
        return $this->belongsTo(Feedpost::class);
    }

}
