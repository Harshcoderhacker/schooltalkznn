<?php

namespace App\Http\Livewire\Aparent\Homework\Homeworkcomments;

use App\Models\Admin\Homework\Homeworklist;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;

class Aparenthomeworkcommentlivewire extends Component
{
    public $user, $body;
    public $homeworkid;
    public $homeworklist;

    protected $rules = [
        'body' => 'required|max:1300',
    ];

    public function mount($homeworkid)
    {
        $this->user = $this->user = Parenthelper::getstudentweb();
        $this->homeworkid = $homeworkid;
    }

    public function sendMessage()
    {
        $this->validate();
        Homeworkcommenthelper::homeworkcommentpost($this->user, $this->body, $this->homeworklist);
        $this->reset('body');
        $this->emit('scroll');
    }

    public function render()
    {
        $this->homeworklist = Homeworklist::where('homework_id', $this->homeworkid)
            ->where('student_id', $this->user->id)->first();
        $this->emit('scroll');
        return view('livewire.aparent.homework.homeworkcomments.aparenthomeworkcommentlivewire');
    }
}
