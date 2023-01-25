<?php

namespace App\Http\Resources\Admin\Exam\Onlineassessment\OAclasswiselist;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminOAClasslistResource extends JsonResource
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
            'classmaster_uuid' => $this->uuid ? $this->uuid : '',
            'classmaster_name' => $this->name ? $this->name : '',
            'assessment_count' => $this->onlineassessment->count(),
        ];
    }
}
