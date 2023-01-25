<?php

namespace App\Http\Resources\Staff\Homework\Homeworklist;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StaffsubjectwisehomeworklistResource extends JsonResource
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
            'description' => $this->description,
            'is_attachment' => $this->attachment ? true : false,
            'attachment_type' => $this->attachment ? explode("/", Storage::mimeType($this->attachment))[1] : '',
            'due_date' => Carbon::parse($this->due_date)->format('d-M-Y'),
            'class_and_section' => ($this->classmaster ? $this->classmaster->name : '') . ' ' . ($this->section ? $this->section->name : ''),
            'submissions' => 'Submissions : ' . $this->homeworklist->where('homework_status', true)->count() . '/' . $this->homeworklist->count(),
            'created_at' => $this->created_at->diffForhumans(),
        ];
    }
}
