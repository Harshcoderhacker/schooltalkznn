<?php

namespace App\Models\Parent\Auth;

use App\Models\Admin\Feeds\Feedpost;
use App\Models\Admin\Settings\Devicetoken\Devicetoken;
use App\Models\Admin\Student\Student;
use App\Models\Commontraits\AuthTraits\HasAuthTrait;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class Aparent extends Authenticatable
{
    use HasApiTokens, Notifiable, SoftDeletes, HasRoles;

    use HasAuthTrait;
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
        'user_code', 'address_lineone', 'address_linetwo', 'student_id', 'student_uuid', 'current_password',
        'mother_name', 'mother_occupation', 'mother_phoneno', 'father_name', 'father_occupation', 'father_phoneno', 'father_office_address',
        'otp'
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
            Helper::autogenerateid(6, 'P', $model);
            $model->usertype = 'PARENT';
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

    public function devicetokenable()
    {
        return $this->morphMany(Devicetoken::class, 'devicetokenable');
    }

    public function feedpost()
    {
        return $this->morphMany(Feedpost::class, 'feedpostable');
    }

    public function student()
    {
        return $this->hasMany(Student::class);
    }
}
