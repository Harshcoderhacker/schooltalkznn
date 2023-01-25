<?php

namespace App\Models\Admin\Homework;

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworkcomment;
use App\Models\Admin\Student\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Homeworklist extends Model
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

        // Homework list Create Event
        // static::updated(function ($homeworklist) {
        //     event(new HomeworklistEvent($homeworklist, auth()->user(), 'REJECTED'));
        // });

    }

    public function homework()
    {
        return $this->belongsTo(Homework::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function homeworkcomment()
    {
        return $this->hasMany(Homeworkcomment::class);
    }
}
