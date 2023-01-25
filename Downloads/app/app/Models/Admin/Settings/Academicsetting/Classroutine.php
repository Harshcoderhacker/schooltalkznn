<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use App\Models\Admin\Staff\Attendance\Staffsmartattendance;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classroutine extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'start_time' => 'datetime:d-M-Y h:i:s',
        'end_time' => 'datetime:d-M-Y h:i:s',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::autogenerateid(8, 'CR', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function getTimeAttribute($value)
    {
        return new \DateTime($value);
    }

    public function timetable()
    {
        return $this->hasMany(Timetable::class);
    }

    public function findclassandsectionforstaff($classroutine_id, $weekday, $staffid)
    {
        $assignsubjectid = Stafftimetable::where('classroutine_id', $classroutine_id)
            ->where('staff_id', $staffid)
            ->first()
            ->$weekday;

        if ($assignsubjectid) {
            $assginsubject = Assignsubject::find($assignsubjectid);
            return $assginsubject->classmaster->name . '-' . $assginsubject->section->name . '<br><small>(' . $assginsubject->subject->name . ')</small>';
        } else {
            $substituteclass = Staff::find($staffid)->substitutor($weekday, $classroutine_id);
            if ($substituteclass) {
                return $substituteclass->classmaster->name . '-' . $substituteclass->section->name . '<br><small>(Substitute)</small>';
            } else {
                return '-';
            }
        }
    }

    public function stafftimetable()
    {
        return $this->hasMany(Stafftimetable::class);
    }

    public function substituteteacher($staffid, $date)
    {
        $assingedstaff = Staffsmartattendance::where('staff_id', $staffid)
            ->where('classroutine_id', $this->id)
            ->where('actual_date', $date)
            ->first();
        if ($assingedstaff) {
            return Staff::find($assingedstaff->assingedstaff_id)->name;
        } else {
            return false;
        }

    }
}
