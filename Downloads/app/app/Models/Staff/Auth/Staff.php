<?php

namespace App\Models\Staff\Auth;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Admin\Gamification\Gamification;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworkcommentpivot;
use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Stafftimetable;
use App\Models\Admin\Settings\Devicetoken\Devicetoken;
use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Admin\Staff\Attendance\Staffattendance;
use App\Models\Admin\Staff\Attendance\Staffattendancelist;
use App\Models\Admin\Staff\Attendance\Staffsmartattendance;
use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Admin\Staff\Payroll\Payrollearndeduct;
use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\Feedtraits\HasFeedTrait;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use App\Models\Staff\Auth\Staffotherdetail;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Staff extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, HasRoles;

    use HasAuthTrait, HasFeedTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'last_name', 'role', 'staffdepartment_id', 'staffdesignation_id', 'marital_status', 'edf_number', 'contract_type_id',
        'staff_roll_id', 'location', 'gender', 'email', 'password', 'last_login_at', 'last_login_ip', 'father_name', 'dob', 'doj', 'phone',
        'emerency_number', 'basic_salary', 'city', 'state', 'pincode', 'experience', 'previous_company', 'address',
        'enable2fa', 'otpstatus', 'google2fa_secret', 'active_flag', 'slack',
        'last_session', 'bank_name', 'account_no', 'ifsc_code', 'bank_branch', 'pan_no', 'aadhar_no',
        'remarks', 'uuid', 'sys_id', 'uniqid', 'sequence_id', 'user_id', 'created_by', 'status',
        'active', 'active_record', 'flag', 'edu_qualification', 'dor', 'relieving_reason', 'is_accountactive',
        'user_code', 'address_lineone', 'address_linetwo', 'otp'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public static function boot()
    {
        parent::boot();

        parent::boot();
        self::creating(function ($model) {
            Helper::autogenerateid(6, 'S', $model);
            $model->usertype = 'STAFF';
            $model->active = true;
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

    public function devicetokenable()
    {
        return $this->morphMany(Devicetoken::class, 'devicetokenable');
    }

    public function staffotherdetail()
    {
        return $this->hasOne(Staffotherdetail::class);
    }

    public function staffdepartment()
    {
        return $this->belongsTo(Staffdepartment::class);
    }

    public function staffdesignation()
    {
        return $this->belongsTo(Staffdesignation::class);
    }

    public function earnings()
    {
        return $this->hasMany(Payrollearndeduct::class)
            ->where('type', 1);
    }

    public function deductions()
    {
        return $this->hasMany(Payrollearndeduct::class)
            ->where('type', 0);
    }

    public function payrolleachmonth()
    {
        return $this->hasMany(Payrolleachmonth::class);
    }

    public function staffattendancelist()
    {
        return $this->hasMany(Staffattendancelist::class);
    }

    public function attendancecount($type)
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where($type, true)
            ->count();
    }

    public function totalpresentdaysinthismonth($month_string, $academicyear_id)
    {
        $totaldays = $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->count();

        $totaldayspresent = $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return ($totaldayspresent != 0 && $totaldays != 0) ? round(($totaldayspresent / $totaldays * 100), 2) : 0;
    }

    public function totalworkingdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->count();
    }

    public function totalholidaydayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', true)
            ->count();
    }

    public function totalpresentdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();
    }

    public function totalabsentdayscountinthismonth($month_string, $academicyear_id)
    {
        return $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('absent', true)
            ->count();
    }

    public function overallattendancepercentage($academicyear_id)
    {
        $totalworkingdaysinthisacademicyear = Staffattendance::where('academicyear_id', $academicyear_id)
            ->where('staffdesignation_id', $this->staffdesignation->id)
            ->where('is_holiday', false)
            ->count();

        $totaldayspresent = $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return ($totalworkingdaysinthisacademicyear != 0 && $totaldayspresent != 0) ? round(($totaldayspresent / $totalworkingdaysinthisacademicyear * 100), 2) : 0;
    }

    public function assignsubject()
    {
        return $this->hasMany(Assignsubject::class);
    }

    public function assignsubjectid()
    {
        return $this->hasMany(Assignsubject::class)->select(['id']);
    }

    // Home work trait
    public function homework()
    {
        return $this->morphMany(Homework::class, 'homeworkable');
    }

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

    public function classroutine()
    {
        return $this->belongsToMany(Classroutine::class, Stafftimetable::class, 'staff_id')->withTimestamps();
    }

    public function stafftimetable()
    {
        return $this->hasMany(Stafftimetable::class);
    }

    public function findtotalclass($day)
    {
        return $this->hasMany(Stafftimetable::class)
            ->whereNotNull($day);
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

    public function assignsubjectcount($day, $date)
    {
        return Staffsmartattendance::where('staff_id', $this->id)
            ->where('day', $day)
            ->where('actual_date', $date)
            ->count();
    }

    public function findselected($day, $date, $classroutineid, $staff_id)
    {
        if (Staffsmartattendance::where('assingedstaff_id', $this->id)
            ->where('staff_id', $staff_id)
            ->where('day', $day)
            ->where('actual_date', $date)
            ->where('classroutine_id', $classroutineid)
            ->first()
        ) {
            return true;
        } else {
            return false;
        }
    }

    public function substitutor($day, $classroutineid)
    {
        $smartattendance = Staffsmartattendance::where('assingedstaff_id', $this->id)
            ->where('day', $day)
            ->where('classroutine_id', $classroutineid)
            ->whereDate('actual_date', '>=', Carbon::today())
            ->first();

        if ($smartattendance) {
            $assignsubjectid = Stafftimetable::where('staff_id', $smartattendance->staff_id)
                ->where('classroutine_id', $classroutineid)
                ->first()
                ->$day;

            return Assignsubject::find($assignsubjectid);
        } else {
            return null;
        }
    }

    public function materiallist()
    {
        return $this->morphMany(Materiallist::class, 'materiallistable');
    }

    // Gamification
    public function gamificationable()
    {
        return $this->morphMany(Gamification::class, 'gamificationable');
    }

    public function getrankingthismonth()
    {
        $collection = collect(Staff::withSum('gamificationable', 'star')
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
        $collection = collect(Staff::withSum('gamificationable', 'star')
                ->orderBy('gamificationable_sum_star', 'desc')
                ->get());
        $data = $collection->where('id', $this->id);
        $value = $data->keys()->first() + 1;
        return $value;
    }

    // Lesson
    public function lesson()
    {
        return $this->morphMany(Lesson::class, 'lessonable');
    }

    // Lesson Topic
    public function lessontopic()
    {
        return $this->morphMany(Lessontopic::class, 'lessontopicable');
    }

    public function overallpresentdays($academicyear_id)
    {
        $totaldayspresent = $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();

        return $totaldayspresent;
    }
    public function overallabsentdays($academicyear_id)
    {
        $totaldaysabsent = $this->hasMany(Staffattendancelist::class)
            ->where('academicyear_id', $academicyear_id)
            ->where('is_holiday', false)
            ->where('absent', true)
            ->count();

        return $totaldaysabsent;
    }

}
