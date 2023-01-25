<?php

namespace App\Http\Resources\Admin\Staff\Payroll;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PayrollResource extends JsonResource
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
            'month_string' => $this->month_string ? Carbon::parse($this->month_string)->format('F Y') : '',
            'payment_date' => $this->payment_date ? $this->payment_date : '',
            'payment_mode' => $this->payment_mode ? config('archive.payment_mode')[$this->payment_mode] : '',
            'basic_salary' => $this->basic_salary ? $this->basic_salary : 0,
            'earning' => $this->earning,
            'deduction' => $this->deduction ? $this->deduction : 0,
            'earned_salary' => $this->net_salary ? $this->net_salary : 0,
            'download_payroll_url' => "adminstaffpayrolldownloadbyuuid/" . $this->uuid,

        ];
    }
}
