<?php

namespace App\Models\Admin\Exam\Offlineexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Academicsetting\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examsubject extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'start' => 'datetime:d-M-Y h:i:s',
        'end' => 'datetime:d-M-Y h:i:s',
        'examdate' => 'datetime:d-M-Y h:i:s',
        'attendance_updated_at' => 'datetime:d-M-Y h:i:s',
        'mark_updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function examstudentsubjectlist()
    {
        return $this->hasMany(Examstudentsubjectlist::class);
    }

}
