<?php

namespace App\Http\Resources\Parent\Exam\Offlineexam\Exammarklist;

use App\Models\Parent\Parenthelper\Parenthelper;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ParentexammarklistResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $date = Carbon::create(2012, $this->month, 1, 0);
        return [
            "month" => $date->format('F'),
            'exams' => ParenteachexammarklistResource::collection($this->examlist(Parenthelper::getstudent())),
        ];
    }
}
