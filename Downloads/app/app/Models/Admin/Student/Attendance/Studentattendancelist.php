<?php

namespace App\Models\Admin\Student\Attendance;

use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Studentattendancelist extends Model
{

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
            $model->uuid = Str::uuid();
        });
    }

    public function studentattendance()
    {
        return $this->belongsTo(Studentattendance::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
