<?php

namespace App\Models\Admin\Feeds;

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Studentidealibrary extends Model
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
            Helper::autogenerateid(4, 'S', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function classmaster()
    {
        return $this->belongsToMany(Classmaster::class)->withTimestamps();
    }

    public function idealibable()
    {
        return $this->morphMany(Feedpost::class, 'idealibable');
    }
}
