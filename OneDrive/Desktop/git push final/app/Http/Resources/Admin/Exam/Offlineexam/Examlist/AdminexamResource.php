<?php

namespace App\Http\Resources\Admin\Exam\Offlineexam\Examlist;

use Illuminate\Http\Resources\Json\JsonResource;

class AdminexamResource extends JsonResource
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
            'exam_uuid' => $this->uuid ? $this->uuid : '',
            'exam_name' => $this->name ? $this->name : '',
        ];
    }
}
