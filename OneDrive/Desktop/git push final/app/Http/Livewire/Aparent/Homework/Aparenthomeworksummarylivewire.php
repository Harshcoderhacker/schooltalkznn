<?php

namespace App\Http\Livewire\Aparent\Homework;

use App\Events\Homeworkevent\HomeworklistEvent;
use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Parent\Parenthelper\Parenthelper;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Aparenthomeworksummarylivewire extends Component
{
    use WithFileUploads;

    public $user;
    public $paginationlength = 10;
    public $homework;
    public $homeworkid;
    public $marks;

    public $submissionfile, $existingsubmissionfile;

    public function mount($homeworkid)
    {
        $this->homeworkid = $homeworkid;
        $this->user = Parenthelper::getstudentweb();
        $this->homework = Homework::find($homeworkid);
        $this->marks = $this->homework->homeworklist->where('homework_id', $homeworkid)->where('student_id', $this->user->id)->first()->marks;
        $this->updatestatus();
    }

    public function downloadhomeworkattachment()
    {
        return Storage::download($this->homework->attachment);
    }

    public function updatestatus()
    {
        $homeworklist = Homeworklist::where('homework_id', $this->homeworkid)->where('student_id', $this->user->id)->first();
        if (collect([1, 4])->contains($homeworklist->staff_homework_status) && $homeworklist->homework_status == false) {
            $homeworklist->update(["staff_homework_status" => 2]);
        }
    }

    public function updatedSubmissionfile()
    {
        $this->validate([
            'submissionfile' => 'mimes:doc,docx,pdf,jpg,png|max:10240',
        ]);

        $newsubmissionfile = $this->submissionfile
            ->storeAs('homeworksubmission/' . Classmaster::find($this->homework->classmaster_id)->uniqid,
                time() . '.' . $this->submissionfile->getClientOriginalExtension());

        $homeworklist = Homeworklist::where('homework_id', $this->homework->id)
            ->where('student_id', $this->user->id)->first();

        $homeworklist->update([
            'submissionfile' => $newsubmissionfile, 'staff_homework_status' => 3, 'homework_status' => 1,
        ]);

        if ($this->existingsubmissionfile) {
            Storage::delete($this->existingsubmissionfile);
        }

        $this->submissionfile = null;
        $this->existingsubmissionfile = $newsubmissionfile;

        $this->dispatchBrowserEvent('successtoast', ['message' => 'File Uploaded Successfully!']);
        event(new HomeworklistEvent($homeworklist, Parenthelper::getstudentweb(), 'SUBMISSION'));
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $homeworklist = Homeworklist::where('homework_id', $this->homeworkid)->where('student_id', $this->user->id)->first();
        $this->existingsubmissionfile = $homeworklist->submissionfile;
        return view('livewire.aparent.homework.aparenthomeworksummarylivewire', compact('homeworklist'));
    }
}
