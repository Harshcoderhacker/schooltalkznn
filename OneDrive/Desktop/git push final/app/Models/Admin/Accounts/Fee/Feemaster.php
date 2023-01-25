<?php

namespace App\Models\Admin\Accounts\Fee;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feemasterparticular;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feemaster extends Model
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

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function aparent()
    {
        return $this->belongsTo(Aparent::class);
    }

    public function feemasterparticular()
    {
        return $this->hasMany(Feemasterparticular::class);
    }

    public function feeassignstudent()
    {
        return $this->hasMany(Feeassignstudent::class);
    }

    public function feestudentpayment()
    {
        return $this->hasMany(Feestudentpayment::class);
    }
}
