<?php

namespace App\Models\Admin\Feeds;

use App\Events\Feedpostevent\NewfeedpostEvent;
use App\Models\Admin\Feeds\Feedcomment;
use App\Models\Admin\Feeds\Feedpoll;
use App\Models\Admin\Feeds\Feedpollcount;
use App\Models\Admin\Feeds\Feedpostlike;
use App\Models\Admin\Feeds\Feedreportedpivot;
use App\Models\Admin\Feeds\Feedtag;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedpost extends Model
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
            Helper::autogenerateid(10, 'FP', $model);
            $model->reported_stage = 1;
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });

        // Event Feed Post
        static::created(function ($feedpost) {
            event(new NewfeedpostEvent($feedpost));
        });
    }

    public function feedpostable()
    {
        return $this->morphTo();
    }

    public function idealibable()
    {
        return $this->morphTo();
    }

    public function feedpostlike()
    {
        return $this->hasMany(Feedpostlike::class);
    }

    public function feedcomment()
    {
        return $this->hasMany(Feedcomment::class);
    }

    public function feedtag()
    {
        return $this->belongsToMany(Feedtag::class, 'feedposttagpivots');
    }

    public function feedpoll()
    {
        return $this->hasMany(Feedpoll::class);
    }

    public function feedpollcount()
    {
        return $this->hasMany(Feedpollcount::class);
    }

    public function feedreportedpivot()
    {
        return $this->hasMany(Feedreportedpivot::class);
    }

    // Attach or Detach
    public function likedpost()
    {
        return $this->belongsToMany(Student::class, 'feedpostlikes', 'feedpostlikeable_id')->withTimestamps();
    }

    // Gamification
    public function gamefunctionable()
    {
        return $this->morphMany(Gamification::class, 'gamefunctionable');
    }

}
