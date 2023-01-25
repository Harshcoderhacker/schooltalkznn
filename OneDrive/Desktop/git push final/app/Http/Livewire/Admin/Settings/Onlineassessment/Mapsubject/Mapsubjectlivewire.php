<?php

namespace App\Http\Livewire\Admin\Settings\Onlineassessment\Mapsubject;

use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use Livewire\Component;

class Mapsubjectlivewire extends Component
{
    public $subjectlist;

    protected $listeners = ['mapsubjectlistrefresh' => '$refresh'];

    public function mount()
    {
        $this->subjectlist = Mapsubject::where('active', true)->get();

    }

    public function render()
    {
        return view('livewire.admin.settings.onlineassessment.mapsubject.mapsubjectlivewire');
    }

}
