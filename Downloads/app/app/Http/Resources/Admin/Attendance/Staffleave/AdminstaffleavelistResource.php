<?php

namespace App\Http\Resources\Admin\Attendance\Staffleave;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminstaffleavelistResource extends JsonResource
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
            'staffleaverequestuuid' => $this->uuid ? $this->uuid : '',
            'name' => $this->staff ? $this->staff->name : '',
            'avatar' => $this->staff ? $this->staff->avatar : '',
            'staffdesignation' => $this->staff ? $this->staff->staffdesignation->name : '',
            'leavetype' => $this->leavetype ? $this->leavetype->name : '',
            'applydate' => $this->created_at->format('d/m/Y'),
            'from_and_to_date' => Carbon::parse($this->from_date)->format('d/m/Y') . ' - ' . Carbon::parse($this->to_date)->format('d/m/Y'),
            'no_of_days' => Carbon::parse($this->to_date)->diffInDays(Carbon::parse($this->from_date)),
            'reason' => $this->reason,

        ];
    }
}
