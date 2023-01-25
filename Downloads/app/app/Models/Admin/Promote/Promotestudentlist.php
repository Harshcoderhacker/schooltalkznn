<?php

namespace App\Models\Admin\Promote;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotestudentlist extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
        'section' => 'json',
    ];

    public function fromacademicyear()
    {
        return $this->belongsTo(Academicyear::class, 'fromacademicyear_id');
    }
}
