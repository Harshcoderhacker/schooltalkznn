<?php

namespace App\Http\Resources\Admin\Attendance\Studentleave;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminstudentleavelistResource extends JsonResource
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
            'name' => $this->student ? $this->student->name : '',
            'avatar' => $this->student ? $this->student->avatar : '',
            'applydate' => $this->created_at->format('d/m/Y'),
            'class_and_section' => ($this->classmaster ? $this->classmaster->name : '') . ' ' . ($this->section ? $this->section->name : ''),
            'from_and_to_date' => Carbon::parse($this->from_date)->format('d/m/Y') . ' - ' . Carbon::parse($this->to_date)->format('d/m/Y'),
            'no_of_days' => Carbon::parse($this->to_date)->diffInDays(Carbon::parse($this->from_date)),
            'reason' => $this->reason,

        ];
    }
}
