<?php

namespace App\Http\Resources\Staff\Classattendance\Classattendancedetail;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassattendancedeabsentlistResource extends JsonResource
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
            'student_name' => $this->student->name,
        ];
    }
}
