<?php

namespace App\Http\Resources\Staff\Homework\Homeworkdetail;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class StaffHomeworkdetailResource extends JsonResource
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
            'homeworklist_uuid' => $this->uuid ? $this->uuid : '',
            'student_name' => $this->student->name,
            'homework_status' => $this->homework_status ? true : false,
            'staff_homework_status' => $this->staff_homework_status,
            'submissionfile_type' => $this->submissionfile ? explode("/", Storage::mimeType($this->submissionfile))[1] : '',
            'comment_count' => $this->homeworkcomment->count(),
            'avatar' => $this->homeworkcommentable ? $this->homeworkcommentable->avatar : '',
            'unread_count' => auth()->user()->homeworkcommentreceiver()
                ->where('homeworklist_id', $this->id)
                ->whereNull('read_at')
                ->count() ? true : false,
        ];
    }
}
