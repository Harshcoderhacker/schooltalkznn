<?php

namespace App\Http\Resources\Staff\Material\Subject;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectlistResource extends JsonResource
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
            'subject_uuid' => $this->subject->uuid,
            'subject_name' => $this->subject->name,
        ];
    }
}
