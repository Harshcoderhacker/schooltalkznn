<?php

namespace App\Models\Admin\Settings\Schoolsetting;

use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Weekend extends Model
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
            Helper::autogenerateid(3, 'WEEK', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }
}
