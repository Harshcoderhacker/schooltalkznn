<?php

namespace App\Models\Admin\Staff\Attendance;

use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;

class Staffattendancelist extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function staffattendance()
    {
        return $this->belongsTo(Staffattendance::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
