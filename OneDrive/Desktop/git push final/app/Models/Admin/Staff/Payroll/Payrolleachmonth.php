<?php

namespace App\Models\Admin\Staff\Payroll;

use App\Models\Admin\Staff\Payroll\Payroll;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Payrolleachmonth extends Model
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
            Helper::autogenerateid(8, 'STAFFPAYROLL', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function payroll()
    {
        return $this->belongsTo(Payroll::class);
    }

}
