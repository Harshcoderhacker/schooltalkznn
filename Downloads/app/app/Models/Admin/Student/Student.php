<?php

namespace App\Models\Admin\Student;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Admin\Emotioncapture\Emotioncapture;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworkcommentpivot;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Attendance\Studentattendance;
use App\Models\Admin\Student\Attendance\Studentattendancelist;
use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\Feedtraits\HasFeedTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Student extends Model
{
    use SoftDeletes;

    use HasAuthTrait, HasFeedTrait, Notifiable;

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
            Helper::autogenerateid(8, 'STU', $model);
            $model->usertype = 'STUDENT';
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    // Is Account Active
    public function scopeIsaccountactive($query)
    {
        return $query->where('active', true)->where('is_accountactive', true);
    }

    // Is Not Account Active
    public function scopeIsnotaccountactive($query)
    {
        return $query->where(fn($q) => $q->where('active', false)
                ->orWhere('is_accountactive', false));
    }

    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function aparent()
    {
        return $this->belongsTo(Aparent::class);
    }

    public function studentattendancelist()
    {
        return $this->hasMany(Studentattendancelist::class);
    }

    public function attendancecount($type)
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where($type, true)
            ->count();
    }

    public function scopeGetourclass($query, $academicyear_id, $classmaster_id, $section_id)
    {
        return $query->where('active', true)
            ->where('academicyear_id', $academicyear_id)
            ->where('classmaster_id', $classmaster_id)
            ->where('section_id', $section_id);
        // ->where('is_accountactive', true);
    }

    public function totalpresentdaysinthismonth($month_string, $academicyear_id)
    {
        $totaldays = $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->count();

        $totaldayspresent = $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return ($totaldayspresent != 0 && $totaldays != 0) ? round(($totaldayspresent / $totaldays * 100), 2) : 0;
    }

    public function overallattendancepercentage($academicyear_id)
    {
        $totalworkingdaysinthisacademicyear = Studentattendance::where('academicyear_id', $academicyear_id)
            ->where('section_id', $this->section_id)
            ->where('classmaster_id', $this->classmaster_id)
            ->where('is_holiday', false)
            ->count();

        $totaldayspresent = $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return ($totalworkingdaysinthisacademicyear != 0 && $totaldayspresent != 0) ? round(($totaldayspresent / $totalworkingdaysinthisacademicyear * 100), 2) : 0;
    }

    public function totalworkingdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->count();
    }

    public function totalholidaydayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', true)
            ->count();
    }

    public function totalpresentdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();
    }

    public function totalabsentdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('absent', true)
            ->count();
    }

    // Homework
    public function homeworkcomment()
    {
        return $this->morphMany(Homeworkcomment::class, 'homeworkcommentable');
    }

    public function homeworkcommentsender()
    {
        return $this->morphMany(Homeworkcommentpivot::class, 'homeworkcommentsender');
    }

    public function homeworkcommentreceiver()
    {
        return $this->morphMany(Homeworkcommentpivot::class, 'homeworkcommentreceiver');
    }

    // Chat Trait

    public function chatgroup()
    {
        return $this->belongsToMany(Chatgroup::class, 'chatparticipants', 'chatparticipantable_id')->withTimestamps();
    }

    public function chatparticipantable()
    {
        return $this->morphMany(Chatparticipant::class, 'chatparticipantable');
    }

    public function chatmessageable()
    {
        return $this->morphMany(Chatmessage::class, 'chatmessageable');
    }

    public function chatmessagereadable()
    {
        return $this->morphMany(Chatmessageread::class, 'chatmessagereadable');
    }

    // Fee

    public function feeassignstudent()
    {
        return $this->hasMany(Feeassignstudent::class);
    }

    public function feeduestudent()
    {
        return $this->hasMany(Feeassignstudent::class)
            ->where('is_selected', true)
            ->where('due_amount', '<>', 0);
    }

    public function selectedfeeassignstudent($feemaster_id)
    {
        if (Feeassignstudent::where('feemaster_id', $feemaster_id)
            ->where('student_id', $this->id)
            ->where('is_lock', true)
            ->first()) {
            return true;
        } else {
            return false;
        }

    }

    public function examstudentlist()
    {
        return $this->hasMany(Examstudentlist::class);
    }

    // Gamification
    public function gamificationable()
    {
        return $this->morphMany(Gamification::class, 'gamificationable');
    }

    public function getrankingthismonth()
    {
        $collection = collect(Student::withSum('gamificationable', 'star')
                ->whereMonth('created_at', date('m'))
                ->whereYear('created_at', date('Y'))
                ->orderBy('gamificationable_sum_star', 'desc')
                ->get());

        $data = $collection->where('id', $this->id);
        $value = $data->keys()->first() + 1;
        return $value;
    }

    public function getrankingoverall()
    {
        $collection = collect(Student::withSum('gamificationable', 'star')
                ->orderBy('gamificationable_sum_star', 'desc')
                ->get());
        $data = $collection->where('id', $this->id);
        $value = $data->keys()->first() + 1;
        return $value;
    }

    public function emotioncapture()
    {
        return $this->hasMany(Emotioncapture::class);
    }

    public function overallpresentdays($academicyear_id)
    {
        $totaldayspresent = $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return $totaldayspresent;
    }
    public function overallabsentdays($academicyear_id)
    {
        $totaldaysabsent = $this->hasMany(Studentattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('absent', true)
            ->count();

        return $totaldaysabsent;
    }

}
