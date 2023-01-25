<?php

namespace App\Http\Resources\Admin\Homework\Homeworksubject;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminhomeworksubjectResource extends JsonResource
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
            'class_and_section' => ($this->classmaster ? $this->classmaster->name : '') . ' ' . ($this->section ? $this->section->name : ''),
            'subject' => $this->subject->name ? $this->subject->name : '',
            'homework_count' => 'Homework: ' . $this->homework->count(),
        ];
    }
}
