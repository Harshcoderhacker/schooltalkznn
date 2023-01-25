<?php

namespace App\Models\Admin\Auth;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Chat\Chatmessage;
use App\Models\Admin\Chat\Chatmessageread;
use App\Models\Admin\Chat\Chatparticipant;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Homework\Homeworkcommentpivot;
use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Lessonplanner\Lessontopic;
use App\Models\Admin\Material\Materiallist;
use App\Models\Admin\Settings\Devicetoken\Devicetoken;
use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Commontraits\Feedtraits\HasFeedTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, HasRoles;

    use HasAuthTrait, HasFeedTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'last_login_at', 'last_login_ip', 'father_name', 'dob', 'doj', 'phone',
        'phone_two', 'address', 'city', 'state', 'pincode', 'experience', 'previous_company',
        'enable2fa', 'otpstatus', 'google2fa_secret', 'active_flag', 'slack',
        'last_session', 'bank_name', 'account_no', 'ifsc_code', 'branch', 'pan_no', 'aadhar_no',
        'remarks', 'uuid', 'sys_id', 'uniqid', 'sequence_id', 'user_id', 'created_by', 'status',
        'active', 'active_record', 'flag', 'edu_qualification', 'dor', 'relieving_reason', 'is_accountactive',
        'user_code', 'avatar','otp'
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
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
            $model->api_token = Str::random(40);
            $model->usertype = 'ADMIN';
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

    // Chat Trait

    public function chatgroup()
    {
        return $this->belongsToMany(Chatgroup::class, 'chatparticipants', 'chatparticipantable_id')->withTimestamps();
    }

    public function chatparticipant()
    {
        return $this->hasMany(Chatparticipant::class);
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

    // Material
    public function materiallist()
    {
        return $this->morphMany(Materiallist::class, 'materiallistable');
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
}
