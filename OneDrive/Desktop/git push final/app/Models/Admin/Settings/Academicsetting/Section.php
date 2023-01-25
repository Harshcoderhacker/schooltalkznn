<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Section extends Model
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
            Helper::autogenerateid(3, 'SEC', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function classmaster()
    {
        return $this->belongsToMany(Classmaster::class)->withTimestamps();
    }

    public function assignsubject()
    {
        return $this->hasMany(Assignsubject::class);
    }
}
