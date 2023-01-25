<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timetable extends Model
{

    public $incrementing = true;

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
            Helper::autogenerateid(3, 'T', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function classroutine()
    {
        return $this->belongsTo(Classroutine::class);
    }

    public function classmastersection()
    {
        return $this->belongsTo(ClassmasterSection::class, 'classmaster_section_id');
    }

    //Not used anywhere need to removed later after verified
    public function findsubjectname($weekday)
    {
        return Assignsubject::find($this->$weekday)->subject->name;
    }

    public function findclassinfo($weekday)
    {
        return Assignsubject::find($this->$weekday);
    }
}
