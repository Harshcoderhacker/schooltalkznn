<?php

namespace App\Http\Livewire\Admin\Homework\Homeworkcomments;

use App\Models\Admin\Auth\User;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Commonhelper\Homeworkcomment\Homeworkcommenthelper;
use Livewire\Component;

class Adminhomeworkcommentlivewire extends Component
{

    public $user, $body;
    public $homeworklist;

    protected $rules = [
        'body' => 'required|max:1300',
    ];

    public function mount(Homeworklist $homeworklist, $platform)
    {$this->platform = $platform;
        if ($platform == "admin") {
            $this->user = auth()->user();
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
        }
        $this->homeworklist = $homeworklist;
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
        $this->homeworklist = Homeworklist::find($this->homeworklist->id);
        $this->emit('scroll');
        return view('livewire.admin.homework.homeworkcomments.adminhomeworkcommentlivewire');
    }
}
