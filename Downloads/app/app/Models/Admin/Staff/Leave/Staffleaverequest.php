<?php

namespace App\Models\Admin\Staff\Leave;

use App\Models\Admin\Settings\Leavesetting\Leavetype;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;

class Staffleaverequest extends Model
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
            Helper::autogenerateid(8, 'L', $model);
            $model->academicyear_id = App::make('generalsetting')->academicyear_id;
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function leavetype()
    {
        return $this->belongsTo(Leavetype::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
