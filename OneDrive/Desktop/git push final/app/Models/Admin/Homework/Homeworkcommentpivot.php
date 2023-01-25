<?php

namespace App\Models\Admin\Homework;

use Illuminate\Database\Eloquent\Model;

class Homeworkcommentpivot extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function homeworkcommentsender()
    {
        return $this->morphTo();
    }

    public function homeworkcommentreceiver()
    {
        return $this->morphTo();
    }

}
