<?php

namespace App\Models\Admin\Emotioncapture;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Emotioncapture extends Model
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
            Helper::autogenerateid(11, 'E', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function aparent()
    {
        return $this->belongsTo(Aparent::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
