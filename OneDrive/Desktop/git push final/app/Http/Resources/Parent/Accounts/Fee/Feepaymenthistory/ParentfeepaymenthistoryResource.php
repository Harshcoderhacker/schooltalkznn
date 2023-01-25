<?php

namespace App\Http\Resources\Parent\Accounts\Fee\Feepaymenthistory;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentfeepaymenthistoryResource extends JsonResource
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
            'total_paid_amount' => $this->total_paid_amount ? $this->total_paid_amount : '',
            'created_at' => $this->created_at ? Carbon::parse($this->created_at)->format('d-M-Y') : '',

        ];
    }
}
