<?php

namespace App\Http\Livewire\Admin\Staff\Staffinfo;

use Livewire\Component;

class Staffprofileinfolivewire extends Component
{
    public $staff;

    public function mount($staff)
    {
        $this->staff = $staff;
    }

    public function render()
    {
        return view('livewire.admin.staff.staffinfo.staffprofileinfolivewire');
    }
}
