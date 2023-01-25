<?php

namespace App\Models\Admin\Staff\Attendance;

use App\Events\Attendanceevent\Staff\SmartattendanceEvent;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Staffsmartattendance extends Model
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
            Helper::autogenerateid(6, 'SA', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });

        // New Staff Assign Create & Update Event
        static::created(function ($smartattendance) {
            event(new SmartattendanceEvent($smartattendance));
        });
        static::updated(function ($smartattendance) {
            event(new SmartattendanceEvent($smartattendance));
        });
    }

    public function assignedstaff()
    {
        return $this->belongsTo(Staff::class, 'assingedstaff_id');
    }
}
