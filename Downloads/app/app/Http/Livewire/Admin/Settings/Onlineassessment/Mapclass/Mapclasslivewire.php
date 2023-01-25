<?php

namespace App\Http\Livewire\Admin\Settings\Onlineassessment\Mapclass;

use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use Livewire\Component;

class Mapclasslivewire extends Component
{
    public $classlist;

    protected $listeners = ['mapclasslistrefresh' => '$refresh'];

    public function mount()
    {

        $this->classlist = Mapclass::where('active', true)->get();

    }

    public function render()
    {
        return view('livewire.admin.settings.onlineassessment.mapclass.mapclasslivewire');
    }

}
