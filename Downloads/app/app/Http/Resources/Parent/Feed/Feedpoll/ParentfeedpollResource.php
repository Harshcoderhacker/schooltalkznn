<?php

namespace App\Http\Resources\Parent\Feed\Feedpoll;

use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentfeedpollResource extends JsonResource
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
            'name' => $this->name ? $this->name : '',
            'ispoll_voted' => (Parenthelper::getstudent()->feedpollcount
                    ->where('feedpost_id', $this->feedpost_id)
                    ->where('feedpoll_id', $this->id)
                    ->count() == 0) ? false : true,
            'pollcount' => $this->pollcount ? $this->pollcount : 0,
            'percentage' => $this->percentage ? $this->percentage : 0,
        ];
    }
}
