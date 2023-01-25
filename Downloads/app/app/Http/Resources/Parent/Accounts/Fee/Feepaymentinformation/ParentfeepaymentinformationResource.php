<?php

namespace App\Http\Resources\Parent\Accounts\Fee\Feepaymentinformation;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentfeepaymentinformationResource extends JsonResource
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
            'name' => $this->feemaster ? $this->feemaster->name : '',
            'actual_amount' => $this->actual_amount ? $this->actual_amount : '',
            'due_date' => $this->feemaster ? Carbon::parse($this->feemaster->due_date)->format('d-M-Y') : '',
            'payment_status' => $this->due_amount == 0 ? 'PAID' : 'UNPAID',

        ];
    }
}
