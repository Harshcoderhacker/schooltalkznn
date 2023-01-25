<?php

namespace App\Models\Admin\Student\Attendance;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Studentattendance extends Model
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

    public function studentattendancelist()
    {
        return $this->hasMany(Studentattendancelist::class);
    }

    public function presentstudent()
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('present', true);
    }

    public function absentstudent()
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('absent', true);
    }

    public function halfdaystudent()
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('halfday', true);
    }

    public function latestudent()
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('late', true);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }
}
