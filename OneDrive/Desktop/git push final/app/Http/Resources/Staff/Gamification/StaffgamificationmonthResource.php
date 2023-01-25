<?php

namespace App\Http\Resources\Staff\Gamification;

use Illuminate\Http\Resources\Json\JsonResource;

class StaffgamificationmonthResource extends JsonResource
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
            'name' => $this->name ? $this->name : '',
            'avatar' => $this->avatar ? $this->avatar : '',
            'star' => $this->gamificationable_sum_star ? $this->gamificationable_sum_star : 0,
            'rank' => $this->getrankingthismonth(),
        ];
    }
}
