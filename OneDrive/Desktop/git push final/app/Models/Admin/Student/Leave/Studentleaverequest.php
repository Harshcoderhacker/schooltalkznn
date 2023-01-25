<?php

namespace App\Models\Admin\Student\Leave;

use Illuminate\Support\Facades\App;
use App\Models\Miscellaneous\Helper;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Classmaster;

class Studentleaverequest extends Model
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
