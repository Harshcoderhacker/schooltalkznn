<?php

namespace App\Models\Admin\Homework;

use App\Events\Homeworkevent\HomeworkcommentEvent;
use App\Models\Admin\Homework\Homeworkcommentpivot;
use App\Models\Admin\Homework\Homeworklist;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Homeworkcomment extends Model
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

        // New Homework Comment Event
        static::created(function ($homeworkcomment) {
            event(new HomeworkcommentEvent($homeworkcomment));
        });

    }

    public function homeworkcommentable()
    {
        return $this->morphTo();
    }

    public function homeworklist()
    {
        return $this->belongsTo(Homeworklist::class);
    }

    public function homeworkcommentpivot()
    {
        return $this->hasMany(Homeworkcommentpivot::class);
    }
}
