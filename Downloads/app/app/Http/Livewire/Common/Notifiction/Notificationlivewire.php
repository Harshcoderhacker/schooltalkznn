<?php

namespace App\Http\Livewire\Common\Notifiction;

use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;

class Notificationlivewire extends Component
{
    public $platform;
    public $openallnotificationsmodal = false;
    public $paginate = 15;

    public function mount($platform)
    {
        if ($platform == "admin") {
            $this->user = auth()->user();
            $this->platform = "admin";
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
            $this->platform = $platform;
        } elseif ($platform == "student") {
            $this->user = Parenthelper::getstudentweb();
            $this->platform = $platform;
        }
    }

    public function notificationsread()
    {
        $this->user->unreadNotifications->markAsRead();
    }

    public function paginate()
    {
        $this->paginate += 15;
    }

    public function render()
    {
        return view('livewire.common.notifiction.notificationlivewire');
    }
}
