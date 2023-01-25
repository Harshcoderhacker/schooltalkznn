<?php

namespace App\Models\Staff\Auth;

use App\Models\Staff\Auth\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Staffotherdetail extends Model
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

    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
