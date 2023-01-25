<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Chat\Chatgroup;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Assignsubject extends Model
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
            Helper::autogenerateid(8, 'AS', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function classmaster()
    {
        return $this->belongsTo(Classmaster::class);
    }

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public function homework()
    {
        return $this->hasMany(Homework::class);
    }

    public function scopeGetsubjectlist($query, $classmaster_id, $section_id)
    {
        return $query->where('classmaster_id', $classmaster_id)
            ->where('section_id', $section_id);
    }

    public function chatgroup()
    {
        return $this->hasMany(Chatgroup::class);
    }
}
