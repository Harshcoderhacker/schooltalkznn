<?php

namespace App\Models\Admin\Chat;

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Chatparticipant extends Model
{
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
            $model->uuid = (string) Str::uuid();
        });
    }

    public function chatparticipantable()
    {
        return $this->morphTo();
    }

    public function chatgroup()
    {
        return $this->belongsTo(Chatgroup::class);
    }
}
