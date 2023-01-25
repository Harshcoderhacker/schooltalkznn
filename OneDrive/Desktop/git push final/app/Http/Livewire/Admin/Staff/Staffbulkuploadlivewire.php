<?php

namespace App\Http\Livewire\Admin\Staff;

use Excel;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Imports\Staff\StaffImport;

class Staffbulkuploadlivewire extends Component
{
    use WithFileUploads, LivewireAlert;

    public $file;

    public function importstaffcsv()
    {

        try {
            DB::beginTransaction();
            Excel::import(new StaffImport(), $this->file);
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Upload Successfully']);
            // $this->formreset();
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

    public function staffbulkuploadsample()
    {
        return response()->download('staff/staffbulkupload/edfishstaffbulkuploadsample.csv');
    }

    public function render()
    {
        return view('livewire.admin.staff.staffbulkuploadlivewire');
    }
}
