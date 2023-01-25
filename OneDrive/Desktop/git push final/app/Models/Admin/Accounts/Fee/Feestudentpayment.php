<?php

namespace App\Models\Admin\Accounts\Fee;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feestudentpayment extends Model
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
            Helper::autogenerateid(8, 'FS', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function feemaster()
    {
        return $this->belongsTo(Feemaster::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

}
