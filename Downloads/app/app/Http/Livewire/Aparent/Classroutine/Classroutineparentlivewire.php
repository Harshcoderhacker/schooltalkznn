<?php

namespace App\Http\Livewire\Aparent\Classroutine;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Timetable;
use App\Models\Parent\Parenthelper\Parenthelper;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Classroutineparentlivewire extends Component
{
    public $user, $timetable, $allassignsubject;

    public function mount()
    {

        $this->user = Parenthelper::getstudentweb();

    }

    public function downloadtimetabe()
    {
        $classmaster = $this->user->classmaster->name;
        $section = $this->user->section->name;
        $timetable = $this->timetable;
        $allassignsubject = $this->allassignsubject;

        $pdf = Pdf::loadView('parent.classroutine.pdf.studenttimetablepdf',
            compact('timetable', 'allassignsubject', 'classmaster', 'section'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Time Table Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'StudentTimeTable.pdf');
    }

    public function render()
    {
        $this->timetable = Timetable::where('classmaster_section_id', ClassmasterSection::where('classmaster_id', $this->user->classmaster_id)
                ->where('section_id', $this->user->section_id)
                ->first()
                ->id)
                ->get();

        $this->allassignsubject = Assignsubject::where('classmaster_id', $this->user->classmaster_id)
            ->where('section_id', $this->user->section_id)
            ->get();
        return view('livewire.aparent.classroutine.classroutineparentlivewire');
    }
}
