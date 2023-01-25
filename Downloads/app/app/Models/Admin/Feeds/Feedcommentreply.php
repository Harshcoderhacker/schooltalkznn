<?php

namespace App\Models\Admin\Feeds;

use App\Events\Feedpostevent\NewfeedcommentreplyEvent;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpost;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Feedcommentreply extends Model
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

        // Event Feed Comment Reply
        static::created(function ($feedcommentreply) {
            event(new NewfeedcommentreplyEvent($feedcommentreply));
        });
    }

    public function feedcommentreplyable()
    {
        return $this->morphTo();
    }

    public function feedpost()
    {
        return $this->belongsTo(Feedpost::class);
    }
    public function feedcomment()
    {
        return $this->belongsTo(Feedcomment::class);
    }
}
