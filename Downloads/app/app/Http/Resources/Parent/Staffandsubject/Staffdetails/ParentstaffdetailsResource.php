<?php

namespace App\Http\Resources\Parent\Staffandsubject\Staffdetails;

use Illuminate\Http\Resources\Json\JsonResource;

class ParentstaffdetailsResource extends JsonResource
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
            'subject' => $this->subject_id ? $this->subject->name : '',
            'staff_name' => $this->staff_id ? $this->staff->name : '-',
        ];
    }
}
