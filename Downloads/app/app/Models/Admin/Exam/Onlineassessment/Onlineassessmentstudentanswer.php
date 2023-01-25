<?php

namespace App\Models\Admin\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;

class Onlineassessmentstudentanswer extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function onlineassessment()
    {
        return $this->belongsTo(Onlineassessment::class);
    }

    public function onlineassessmentquestion()
    {
        return $this->belongsTo(Onlineassessmentquestion::class);
    }

    public function onlineassessmentstudentlist()
    {
        return $this->belongsTo(Onlineassessmentstudentlist::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
