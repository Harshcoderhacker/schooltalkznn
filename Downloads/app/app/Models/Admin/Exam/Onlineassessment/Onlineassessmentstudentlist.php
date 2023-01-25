<?php

namespace App\Models\Admin\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentanswer;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Onlineassessmentstudentlist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'participated_date' => 'datetime:d-M-Y h:i:s',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function onlineassessment()
    {
        return $this->belongsTo(Onlineassessment::class);
    }
    public function onlineassessmentstudentanswer()
    {
        return $this->hasMany(Onlineassessmentstudentanswer::class);
    }
}
