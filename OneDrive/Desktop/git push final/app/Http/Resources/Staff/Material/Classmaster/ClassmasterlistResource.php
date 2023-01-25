<?php

namespace App\Http\Resources\Staff\Material\Classmaster;

use Illuminate\Http\Resources\Json\JsonResource;

class ClassmasterlistResource extends JsonResource
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
            'classmaster_uuid' => $this->classmaster->uuid,
            'classmaster_name' => $this->classmaster->name,
        ];
    }
}
