<?php

namespace App\Models\Admin\Accounts\Fee;

use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feeassignstudent extends Model
{
    use SoftDeletes;

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
            Helper::autogenerateid(8, 'SF', $model);
            $model->total_paid_amount = 0;
            $model->is_lock = false;
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function feemaster()
    {
        return $this->belongsTo(Feemaster::class);
    }

    public function aparent()
    {
        return $this->belongsTo(Aparent::class);
    }

    public function feestudentpayment()
    {
        return $this->hasMany(Feestudentpayment::class);
    }

}
