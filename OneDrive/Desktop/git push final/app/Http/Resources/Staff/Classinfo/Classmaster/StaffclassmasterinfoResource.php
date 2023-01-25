<?php

namespace App\Http\Resources\Staff\Classinfo\Classmaster;

use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use Illuminate\Http\Resources\Json\JsonResource;

class StaffclassmasterinfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $classmasteruuid =
        return [
            'classname' => 'Class ' . $this->classmaster->name . ' - ' . $this->section->name,
            'classmastersection_uuid' => ClassmasterSection::where('classmaster_id', $this->classmaster_id)
                ->where('section_id', $this->section->id)
                ->first()->uuid,
        ];
    }
}
