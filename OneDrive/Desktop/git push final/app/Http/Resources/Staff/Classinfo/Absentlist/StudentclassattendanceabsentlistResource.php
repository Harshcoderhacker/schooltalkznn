<?php

namespace App\Http\Resources\Staff\Classinfo\Absentlist;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentclassattendanceabsentlistResource extends JsonResource
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
