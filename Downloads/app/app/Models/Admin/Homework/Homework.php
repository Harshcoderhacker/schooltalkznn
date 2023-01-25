<?php

namespace App\Models\Admin\Homework;

use App\Events\Homeworkevent\HomeworkEvent;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Homework extends Model
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
            Helper::autogenerateid(3, 'H', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });

        // New Homework Create Event
        static::created(function ($homeworklist) {
            event(new HomeworkEvent($homeworklist));
        });
    }

    public function homeworkable()
    {
        return $this->morphTo();
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

    public function assignsubject()
    {
        return $this->belongsTo(Assignsubject::class);
    }

    public function homeworklist()
    {
        return $this->hasMany(Homeworklist::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
