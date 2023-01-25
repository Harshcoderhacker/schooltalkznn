<?php

namespace App\Models\Admin\Exam\Offlineexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Examstudentlist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public function examstudentsubjectlist()
    {
        return $this->hasMany(Examstudentsubjectlist::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function findavg($examstudentlist)
    {
        return $examstudentlist;
    }

    public function findrank($student_id)
    {
        $studentlist = Examstudentlist::where('exam_id', $this->exam_id)->get();
        $total_mark = [];
        foreach ($studentlist as $key => $eachstudent) {
            $examstudentlist = Examstudentlist::with('examstudentsubjectlist')->where('exam_id', $this->exam_id)->where('student_id', $eachstudent->student_id)->where('classmaster_id', $this->classmaster_id)
                ->where('section_id', $this->section_id)->get();
            if (sizeof($examstudentlist[0]->examstudentsubjectlist) == $examstudentlist[0]->examstudentsubjectlist->where('is_pass', true)->count()) {
                $total_mark[$eachstudent->student_id] = $examstudentlist[0]->examstudentsubjectlist->sum('subjectmark_percentage');

            }
        }
        arsort($total_mark);

        $list = $this->hasMany(Examstudentsubjectlist::class);
        $overallcount = $list->count();

        $passcount = $list
            ->where('is_pass', true)
            ->count();

        if ($overallcount != $passcount) {
            return '-';
        } else {
            $rank = (string) array_search($list->where('is_pass', true)->sum('subjectmark_percentage'), $total_mark);
            return $rank;
        }
    }
}
