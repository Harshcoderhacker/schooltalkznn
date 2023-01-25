<?php

namespace App\Http\Resources\Parent\Homework\Homeworkdetails;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ParenthomeworkdetailsResource extends JsonResource
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
            'homeworklist_uuid' => $this->uuid,
            'homework_uuid' => $this->homework->uuid,
            'title' => $this->homework->title,
            'description' => $this->homework->description,
            'is_attachment' => $this->homework->attachment ? true : false,
            'attachment_type' => $this->homework->attachment ? explode("/", Storage::mimeType($this->homework->attachment))[1] : '',
            'marks' => 'Marks : ' . ($this->marks ? $this->marks : 0) . '/' . ($this->homework->marks ? $this->homework->marks : 0),
            'subject' => $this->homework->assignsubject?->subject ? $this->homework->assignsubject?->subject->name : '',
            'due_date' => Carbon::parse($this->due_date)->format('d-M-Y'),
            'homework_status' => $this->homework_status ? true : false,
            'staff_homework_status' => $this->staff_homework_status,
            'is_message' => (($this->homework_status == false) && ($this->submissionfile)) ? true : false,
            'created_at' => $this->created_at->diffForhumans(),
        ];
    }
}
