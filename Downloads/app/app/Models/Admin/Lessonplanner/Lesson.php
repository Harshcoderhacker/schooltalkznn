<?php

namespace App\Models\Admin\Lessonplanner;

use App\Models\Admin\Lessonplanner\Lessontopic;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Lesson extends Model
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
            Helper::autogenerateid(5, 'LE', $model);
        });
    }

    public function lessonable()
    {
        return $this->morphTo();
    }

    public function lessontopic()
    {
        return $this->hasMany(Lessontopic::class);
    }

    public function classmaster()
    {
        return $this->belongsTO(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTO(Section::class);
    }

    public function subject()
    {
        return $this->belongsTO(Subject::class);
    }

}
