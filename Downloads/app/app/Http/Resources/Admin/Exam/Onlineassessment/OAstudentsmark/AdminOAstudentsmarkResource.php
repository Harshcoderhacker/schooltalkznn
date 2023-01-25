<?php

namespace App\Http\Resources\Admin\Exam\Onlineassessment\OAstudentsmark;

use App\Http\Resources\Admin\Exam\Onlineassessment\OAstudentsmark\AdminOAstudentanswerResource;
use App\Models\Admin\Settings\Examsetting\Exampasspercentage;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminOAstudentsmarkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $exampasspercentage = Exampasspercentage::first()->pass_percentage;
        if ($this->mark !== null) {
            $percentage = round(($this->mark / $this->onlineassessment->total_mark) * 100);
            if ($percentage >= $exampasspercentage) {
                $result = "Pass";
            } else {
                $result = "Fail";
            }
        } else {
            $result = "";
        }
        return [
            'student_name' => $this->student_id ? $this->student->name : '',
            'classmaster_name' => $this->classmaster_id ? $this->classmaster->name : '',
            'mark' => $this->mark !== null ? $this->mark . '/' . $this->onlineassessment->total_mark : '',
            'result' => $result,
            'answer_details' => AdminOAstudentanswerResource::collection($this->onlineassessmentstudentanswer),
        ];
    }
}
