<?php

namespace App\Models\Admin\Settings\Schoolsetting;

use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use Illuminate\Database\Eloquent\Model;

class Academicyearmonthlist extends Model
{
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
    public function academicyear()
    {
        return $this->belongsTo(Academicyear::class);
    }
}
