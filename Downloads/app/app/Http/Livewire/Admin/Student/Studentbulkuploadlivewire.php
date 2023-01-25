<?php

namespace App\Http\Livewire\Admin\Student;

use App\Imports\Student\StudentImport;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;

class Studentbulkuploadlivewire extends Component
{
    use WithFileUploads, LivewireAlert;

    public $academicyear, $classmaster, $section = [];
    public $academicyearid, $classmasterid, $sectionid;
    public $file;

    public function mount()
    {
        $this->academicyear = Academicyear::where('active', true)->get();
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->section = [];
    }

    public function updatedClassmasterid()
    {
        $this->sectionid = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function formreset()
    {
        $this->academicyearid = null;
        $this->classmasterid = null;
        $this->sectionid = null;
        $this->file = null;
    }

    public function importstudentcsv()
    {
        $this->validate([
            'academicyearid' => 'required|integer',
            'classmasterid' => 'required|integer',
            'sectionid' => 'required|integer',
            'file' => 'required|file|mimes:xls,xlsx,csv',
        ]);
        try {
            DB::beginTransaction();
            Excel::import(new StudentImport($this->academicyearid, $this->classmasterid, $this->sectionid), $this->file);
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Student Upload Successfully']);
            $this->formreset();
        } catch (ValidationException $e) {
            $failures = $e->failures();
            foreach ($failures as $failure) {
                $this->alert('error', ' Heading : ' . $failure->attribute()
                    . ' Name : ' . $failure->values()['name']
                    . ' Row : ' . $failure->row() . ' Error : '
                    . $failure->errors()[0], [
                        'position' => 'top-end',
                        'timer' => '6000',
                        'toast' => true,
                        'timerProgressBar' => true,
                    ]);
            }
            DB::rollback();
        }
    }

    public function studentbulkuploadsample()
    {
        return response()->download('student/studentbulkupload/edfishstudentbulkuploadsample.csv');
    }

    public function render()
    {
        return view('livewire.admin.student.studentbulkuploadlivewire');
    }
}
