<?php

namespace App\Models\Admin\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onlineassessment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'start_date' => 'datetime:d-M-Y h:i:s',
        'end_date' => 'datetime:d-M-Y h:i:s',
        'section' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::autogenerateid(6, 'OA', $model);
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

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function onlineassessmentquestion()
    {
        return $this->hasMany(Onlineassessmentquestion::class);
    }

    public function onlineassessmentstudentlist()
    {
        return $this->hasMany(Onlineassessmentstudentlist::class);
    }

}
