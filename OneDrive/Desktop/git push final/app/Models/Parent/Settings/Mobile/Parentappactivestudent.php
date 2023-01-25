<?php

namespace App\Models\Parent\Settings\Mobile;

use Illuminate\Database\Eloquent\Model;

class Parentappactivestudent extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];
}
