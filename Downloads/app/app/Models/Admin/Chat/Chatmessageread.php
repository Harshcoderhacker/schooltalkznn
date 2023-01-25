<?php

namespace App\Models\Admin\Chat;

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Database\Eloquent\Model;

class Chatmessageread extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    protected $casts = [
        'created_at' => 'datetime:d-M-Y h:i:s',
        'updated_at' => 'datetime:d-M-Y h:i:s',
    ];

    public function chatmessagereadable()
    {
        return $this->morphTo();
    }

    public function chatgroup()
    {
        return $this->belongsTo(Chatgroup::class);
    }
}
