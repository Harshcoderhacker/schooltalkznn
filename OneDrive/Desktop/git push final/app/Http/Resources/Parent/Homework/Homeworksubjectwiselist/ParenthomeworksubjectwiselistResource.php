<?php

namespace App\Http\Resources\Parent\Homework\Homeworksubjectwiselist;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParenthomeworksubjectwiselistResource extends JsonResource
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
            'homeworklist_uuid' => $this->homeworklist ? $this->homeworklist[0]->uuid : '',
            'title' => $this->title,
            'due_date' => Carbon::parse($this->due_date)->format('d-M-Y'),
            'homework_status' => $this->homeworklist[0]->homework_status ? true : false,
            'staff_homework_status' => $this->homeworklist[0]->staff_homework_status,
            'created_at' => $this->created_at->diffForhumans(),
        ];
    }
}
