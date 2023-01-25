<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Material\Material;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Miscellaneous\Helper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Classmaster extends Model
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
            Helper::autogenerateid(3, 'C', $model);
        });
        static::updating(function ($model) {
            Helper::autogenerateid(false, false, $model);
        });
    }

    public function section()
    {
        return $this->belongsToMany(Section::class)->withTimestamps();
    }

    public function materialwithtype()
    {
        return $this->hasMany(Material::class)
            ->where('material_type', request('material_type'));
    }
    public function onlineassessment()
    {
        return $this->hasMany(Onlineassessment::class);
    }

    public function assignsubject()
    {
        return $this->hasMany(Assignsubject::class);
    }

}
