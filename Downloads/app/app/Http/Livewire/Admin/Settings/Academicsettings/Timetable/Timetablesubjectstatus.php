<?php

namespace App\Http\Livewire\Admin\Settings\Academicsettings\Timetable;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use Livewire\Component;

class Timetablesubjectstatus extends Component
{

    public $classmasterid, $sectionid;
    public $eachtimetable, $day;
    public $assignsubject;

    public function mount($eachtimetable, $day)
    {
        $this->eachtimetable = $eachtimetable;
        $this->day = $day;
    }

    public function changeEvent($subjectid)
    {
        ($subjectid) ? Timetable::find($this->eachtimetable->id)->update([$this->day => $subjectid]) : '';

    }

    public function render()
    {

        $this->assignsubject = Assignsubject::where('classmaster_id', $this->classmasterid)
            ->where('section_id', $this->sectionid)
            ->get();

        return view('livewire.admin.settings.academicsettings.timetable.timetablesubjectstatus');
    }
}
