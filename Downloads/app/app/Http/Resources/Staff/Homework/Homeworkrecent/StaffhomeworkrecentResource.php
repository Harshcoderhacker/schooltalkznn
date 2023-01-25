<?php

namespace App\Http\Resources\Staff\Homework\Homeworkrecent;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffhomeworkrecentResource extends JsonResource
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
            'homework_uuid' => $this->uuid ? $this->uuid : '',
            'title' => $this->title,
            'due_date' => Carbon::parse($this->due_date)->format('d-M-Y'),
            'subject' => $this->assignsubject->subject->name ? $this->assignsubject->subject->name : '',
            'class_and_section' => ($this->classmaster ? $this->classmaster->name : '') . ' ' . ($this->section ? $this->section->name : ''),
            'completion' => 'Completion : ' . $this->homeworklist->where('homework_status', true)->count() . '/' . $this->homeworklist->count(),
            'created_at' => $this->created_at->diffForhumans(),
        ];
    }
}
