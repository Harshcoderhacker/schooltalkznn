<?php

namespace App\Http\Resources\Parent\Accounts\Fee\Pendingfeelist;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentpendingfeeResource extends JsonResource
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
            'uuid' => $this->uuid ? $this->uuid : '',
            'name' => $this->feemaster ? $this->feemaster->name : '',
            'due_amount' => $this->due_amount ? round($this->due_amount, 2) : '',
            'due_date' => $this->feemaster ? Carbon::parse($this->feemaster->due_date)->format('d-M-Y') : '',

        ];
    }
}
