<?php

namespace App\Http\Resources\Common\Notification;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Student\Student;
use App\Models\Staff\Auth\Staff;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Log;

class UsernotificationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $avatar = '';
        switch ($this->data && isset($this->data['usertype']) && $this->data['usertype']) {
            case 'ADMIN':
                $avatar = User::find($this->data['user_id'])?->avatar;
                break;
            case 'STAFF':
                $avatar = Staff::find($this->data['user_id'])?->avatar;
                break;
            case 'STUDENT':
                $avatar = Student::find($this->data['user_id'])?->avatar;
                break;
            default:
                Log::error('------ Invalid Type -----UsernotificationResource-----');
        }

        return [
            'uuid' => $this->id ? $this->id : '',
            'fullname' => $this->data ? $this->data['fullname'] : '',
            'message' => $this->data ? $this->data['message'] : '',
            'typeflag' => $this->data ? $this->data['typeflag'] : '',
            'created_at' => $this->created_at ? $this->created_at->diffForhumans(null, true) : '',
            'read_at' => $this->read_at ? $this->read_at->diffForhumans() : '',
            'avatar' => ($avatar == null) ? '' : $avatar,
        ];
    }
}
