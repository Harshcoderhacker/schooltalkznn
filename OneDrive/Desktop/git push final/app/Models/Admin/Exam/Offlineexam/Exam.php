<?php

namespace App\Models\Admin\Exam\Offlineexam;

use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Exam extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'section' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            Helper::autogenerateid(6, 'F', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function examsubject()
    {
        return $this->hasMany(Examsubject::class);
    }

    public function examstudentsubjectlist()
    {
        return $this->hasMany(Examstudentsubjectlist::class);
    }

    public function examstudentlist()
    {
        return $this->hasMany(Examstudentlist::class);
    }

    public function exampassstudentlist()
    {
        return $this->hasMany(Examstudentlist::class);
    }

    public function findmark($stundetid, $examstudentlist)
    {
        $examstudentlistid = Examstudentlist::where('exam_id', $this->id)
            ->where('student_id', $stundetid)
            ->first();
        if ($examstudentlistid) {
            $marklist = Examstudentsubjectlist::where('exam_id', $this->id)
                ->where('examstudentlist_id', $examstudentlistid->id)
                ->where('subject_id', $examstudentlist->subject_id)
                ->first();
            if ($marklist) {
                return $marklist->subjectmark_percentage;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }

    public function overallmark($studentid, $subjectid)
    {
        $examstudentlistid = Examstudentlist::where('exam_id', $this->id)
            ->where('student_id', $studentid)
            ->first();
        $mark = Examstudentsubjectlist::where('exam_id', $this->id)
            ->where('examstudentlist_id', $examstudentlistid->id)
            ->where('subject_id', $subjectid)
            ->first();
        if ($mark) {
            return $mark->subjectmark_percentage;
        } else {
            return "-";
        }
    }

    public function remark($studentid, $subjectid)
    {
        $examstudentlistid = Examstudentlist::where('exam_id', $this->id)
            ->where('student_id', $studentid)
            ->first();
        $remark = Examstudentsubjectlist::where('exam_id', $this->id)
            ->where('examstudentlist_id', $examstudentlistid->id)
            ->where('subject_id', $subjectid)
            ->first();
        if ($remark) {
            return $remark->remarks;
        } else {
            return " ";
        }
    }

    public function examlist($user)
    {
        return Exam::where('month', $this->month)
            ->where('academicyear_id', $this->academicyear_id)
            ->where('classmaster_id', $user->classmaster_id)
            ->whereJsonContains('section', (string) $user->section_id)
        // ->with('examsubject')
            ->get();
    }
}
