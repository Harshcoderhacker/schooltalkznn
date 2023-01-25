<?php

namespace App\Http\Resources\Admin\Settings\Academicsetting\Section;

use Illuminate\Http\Resources\Json\JsonResource;

class SectionResource extends JsonResource
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
            'section_uuid' => $this->uuid ? $this->uuid : '',
            'section_name' => $this->name ? $this->name : '',
        ];
    }
}
