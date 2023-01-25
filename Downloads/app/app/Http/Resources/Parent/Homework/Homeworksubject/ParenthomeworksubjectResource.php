<?php

namespace App\Http\Resources\Parent\Homework\Homeworksubject;

use App\Models\Admin\Homework\Homeworklist;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Resources\Json\JsonResource;

class ParenthomeworksubjectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'assignsubject_uuid' => $this->uuid ? $this->uuid : '',
            'subject' => $this->subject ? $this->subject->name : '',
            'unread_count' => Homeworklist::where('student_id', Parenthelper::getstudent()->id)
                ->whereNull('read_at')
                ->whereHas('homework', fn(Builder $q) =>
                    $q->whereHas('assignsubject', fn(Builder $q) =>
                        $q->where('subject_id', $this->subject->id)))
                ->count(),
        ];
    }
}
