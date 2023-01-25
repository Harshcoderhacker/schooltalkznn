<?php

namespace App\Models\Admin\Material;

use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Material extends Model
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
            Helper::autogenerateid(3, 'MT', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function materiallist()
    {
        return $this->hasMany(Materiallist::class);
    }
}
