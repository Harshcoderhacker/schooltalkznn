<?php

namespace App\Models\Admin\Settings\Academicsetting;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ClassmasterSection extends Pivot
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function classroutine()
    {
        return $this->belongsToMany(Classroutine::class, Timetable::class, 'classmaster_section_id', 'classroutine_id')->withTimestamps();
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
