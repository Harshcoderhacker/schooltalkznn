<?php

namespace App\Http\Resources\Admin\Feed\Feedreported\Feedreportedpostbyuuid;

use App\Models\Admin\Feeds\Feedreported;
use Illuminate\Http\Resources\Json\JsonResource;

class FeedreportedpostbyuuidResource extends JsonResource
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
            'name' => $this->feedreportedpivotable->name . ' (' . $this->feedreportedpivotable->usertype . ')',
            'reported' => Feedreported::find($this->feedreported_id)->name,

        ];
    }
}
