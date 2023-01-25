<?php

namespace App\Http\Livewire\Admin\Lessonplanner;

use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Progresstracklivewire extends Component
{
    public $classmasterid, $sectionid;
    public $classmasterlist, $sectionlist;
    public function mount()
    {
        $this->classmasterlist = Classmaster::where('active', true)->get();
        $this->sectionlist = [];
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid && is_numeric($this->classmasterid)) {
            $this->sectionlist = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->sectionlist = [];
        }
    }

    public function downloadexportprogress()
    {
        $assignsubject = Assignsubject::where(fn($query) => $query->where('classmaster_id', $this->classmasterid))
            ->where(fn($query) => $query->where('section_id', $this->sectionid))
            ->get();
        $classmaster = Classmaster::find($this->classmasterid);
        $section = Section::find($this->sectionid);
        $month = [6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec', 1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May'];
        $pdf = Pdf::loadView('admin.lessonplanner.exportprogresspdf',
            compact('assignsubject', 'month', 'classmaster', 'section'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Export progress Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'lessonplannerprogress.pdf');

    }

    public function render()
    {
        $assignsubject = Assignsubject::where(fn($query) => $query->where('classmaster_id', $this->classmasterid))
            ->where(fn($query) => $query->where('section_id', $this->sectionid))
            ->get();
        $month = [6 => 'Jun', 7 => 'Jul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Nov', 12 => 'Dec', 1 => 'Jan', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'May'];
        return view('livewire.admin.lessonplanner.progresstracklivewire',
            compact('assignsubject', 'month'));
    }
}
