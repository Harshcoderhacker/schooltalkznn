<?php

namespace App\Models\Admin\Exam\Offlineexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Settings\Academicsetting\Subject;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examstudentsubjectlist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function examstudentlist()
    {
        return $this->belongsTo(Examstudentlist::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
}
