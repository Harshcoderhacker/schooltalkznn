<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examstudentlist;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminexamstudentlistResource extends JsonResource
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
            'student_uuid' => $this->uuid ? $this->uuid : '',
            'student_name' => $this->name ? $this->name : '',
        ];
    }
}
