<?php

namespace App\Models\Admin\Chat;

use App\Models\Admin\Chat\Chatgroup;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Chatmessage extends Model
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
            $model->uuid = (string) Str::uuid();
        });
    }

    public function chatmessageable()
    {
        return $this->morphTo();
    }

    // public function chatmessagereceiver()
    // {
    //     return $this->morphTo();
    // }

    public function chatgroup()
    {
        return $this->belongsTo(Chatgroup::class);
    }
}
