<?php

namespace App\Http\Resources\Parent\Homework\Homeworkcomment;

use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Http\Resources\Json\JsonResource;

class ParenthomeworkcommentResource extends JsonResource
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
            'comment_uuid' => $this->uuid ? $this->uuid : '',
            'body' => $this->body ? $this->body : '',
            'usertype' => $this->homeworkcommentable ? $this->homeworkcommentable->usertype : '',
            'avatar' => $this->homeworkcommentable ? $this->homeworkcommentable->avatar : '',
            'created_at' => $this->created_at->format('d M h:i a'),
            'alligntype' => ($this->homeworkcommentable->uuid == Parenthelper::getstudent()->uuid) ? 'right' : 'left',
        ];
    }
}
