<?php

namespace App\Models\Admin\Staff\Attendance;

use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendancelist;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Staffattendance extends Model
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
            Helper::autogenerateid(10, 'A', $model);
            $model->academicyear_id = App::make('generalsetting')->academicyear_id;
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function staffattendancelist()
    {
        return $this->hasMany(Staffattendancelist::class);
    }

    public function staffdesignation()
    {
        return $this->belongsTo(Staffdesignation::class);
    }

    public function presentstaff()
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('present', true);
    }

    public function absentstaff()
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('absent', true);
    }

    public function latestaff()
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('late', true);
    }
}
