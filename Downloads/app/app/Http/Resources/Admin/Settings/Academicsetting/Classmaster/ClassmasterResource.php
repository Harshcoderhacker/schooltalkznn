<?php

namespace App\Http\Resources\Admin\Settings\Academicsetting\Classmaster;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassmasterResource extends JsonResource
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
            'class_uuid' => $this->uuid ? $this->uuid : '',
            'class_name' => $this->name ? $this->name : '',
        ];
    }
}
