<?php

namespace App\Models\Admin\Feeds;

use App\Events\Feedpostevent\NewfeedcommentEvent;
use App\Models\Admin\Feeds\Feedcommentreply;
use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Feedcomment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });

        // Event Feed Comment
        static::created(function ($feedcomment) {
            event(new NewfeedcommentEvent($feedcomment));
        });
    }

    public function feedcommentable()
    {
        return $this->morphTo();
    }

    // public function feedpost()
    // {
    //     return $this->belongsTo(Feedpost::class);
    // }

    public function feedpost()
    {
        return $this->belongsTo(Feedpost::class);
    }

    public function feedcommentreply()
    {
        return $this->hasMany(Feedcommentreply::class);
    }
}
