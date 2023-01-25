<?php

namespace App\Models\Admin\Feeds;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Feedpollcount extends Model
{
    protected $dates = ['deleted_at'];
    protected $guarded = ['id'];

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }

    public function feedpollcountable()
    {
        return $this->morphTo();
    }
}
