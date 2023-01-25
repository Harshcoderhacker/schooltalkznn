<?php

namespace App\Http\Livewire\Admin\Homework;

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class Homeworkindexlivewire extends Component
{
    use WithFileUploads, WithPagination;

    public $user, $platform, $paginationlength = 10, $count, $completionpercentage = 0;
    public $createhomeworkmodal = false;
    public $allclassmaster, $classmaster_id;
    public $section_id, $section, $assignsubject_id;
    public $marks, $due_date, $attachment, $title, $description;
    public $academicyear_id;
    public $completion;

    public function mount($platform)
    {
        $today = Carbon::today();

        if ($platform == "admin") {

            $this->user = auth()->user();
            $this->count = Homework::whereDate('created_at', Carbon::today())->count();
            $completion = Homeworklist::where('homework_status', true)->count();
            $this->completionpercentage = ($completion > 0) ? round(($completion / Homeworklist::count()) * 100) : 0;

// Homeworklist::where('homework_status', true)->groupBy()
// class section wise homework
//             total homework
//             compelte

        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
            $this->count = $this->user->homework()->whereDate('created_at', Carbon::today())->count();
            $completion = Homeworklist::where('homework_status', true)
                ->whereHas('homework', fn(Builder $q) => $q->where('staff_id', $this->user->id))
                ->count();
            $totalhomework = Homeworklist::whereHas('homework', fn(Builder $q) => $q->where('staff_id', $this->user->id))->count();
            $this->completionpercentage = ($completion > 0) ? round(($completion / $totalhomework) * 100) : 0;

        }

        $this->platform = $platform;
        $this->allclassmaster = Classmaster::where('active', true)->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->section = [];
    }

    protected function rules()
    {
        return [
            'classmaster_id' => 'required|integer',
            'section_id' => 'required|integer',
            'assignsubject_id' => 'required|integer',
            'due_date' => 'required|date|after:yesterday',
            'marks' => 'required|integer|max:100',
            'attachment' => 'nullable|mimes:doc,docx,pdf,jpg,png|max:10240',
            'title' => 'required|min:3|max:60',
            'description' => 'required|string|max:1300',
        ];
    }

    protected $messages = [
        'due_date.after' => 'Invalid Date',
    ];

    public function updatedClassmasterid()
    {
        $this->section_id = '';
        if ($this->classmaster_id) {
            $this->section = Classmaster::find($this->classmaster_id)->section;
        } else {
            $this->section = [];
        }
    }

    public function createorupdatehomework()
    {
        $validation = $this->validate();

        try {
            DB::beginTransaction();
            if ($this->attachment) {
                $validation['attachment'] = $this->attachment
                    ->storeAs('homework/' . Classmaster::find($this->classmaster_id)->uniqid,
                        time() . '.' . $this->attachment->getClientOriginalExtension());
            }
            $validation['academicyear_id'] = $this->academicyear_id;
            $validation['staff_id'] = Assignsubject::find($this->assignsubject_id)->staff_id;
            $validation['usertype'] = $this->user->usertype;

            $homework = $this->user
                ->homework()
                ->save(new Homework($validation));

            Student::getourclass($this->academicyear_id, $this->classmaster_id, $this->section_id)
                ->pluck('id')
                ->each(fn($eachstudent_id) =>
                    $homework->homeworklist()->create(['student_id' => $eachstudent_id]));

            Helper::trackmessage($this->user, 'Homework Create', 'homework_create', session()->getId(), 'WEB');

            DB::commit();
            $this->closecreatehomeworkmodal();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Homework Added Successfully!']);

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function formreset()
    {
        $this->classmaster_id = '';
        $this->section_id = '';
        $this->assignsubject_id = '';
        $this->due_date = '';
        $this->marks = '';
        $this->attachment = '';
        $this->title = '';
        $this->description = '';
    }

    public function createhomeworkmodal()
    {
        $this->createhomeworkmodal = true;
    }

    public function closecreatehomeworkmodal()
    {
        $this->formreset();
        $this->resetErrorBag();
        $this->createhomeworkmodal = false;
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        if ($this->platform == "admin") {
            $homeworklist = Homework::where('academicyear_id', $this->academicyear_id)
                ->where(fn($query) => ($this->classmaster_id) ? $query->where('classmaster_id', $this->classmaster_id) : '')
                ->where(fn($query) => ($this->section_id) ? $query->where('section_id', $this->section_id) : '')
                ->where(fn($query) => ($this->assignsubject_id) ? $query->where('assignsubject_id', $this->assignsubject_id) : '')
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);

            $this->allassignsubject = Assignsubject::where('classmaster_id', $this->classmaster_id)
                ->where('section_id', $this->section_id)
                ->get();
        }
        if ($this->platform == "staff") {
            $homeworklist = Homework::whereHas('assignsubject',
                fn(Builder $q) => $q->where('staff_id', $this->user->id))
                ->latest()
                ->paginate($this->paginationlength)->onEachSide(1);

            $this->allassignsubject = Assignsubject::where('staff_id', $this->user->id)
                ->where('classmaster_id', $this->classmaster_id)
                ->where('section_id', $this->section_id)
                ->get();
        }
        return view('livewire.admin.homework.homeworkindexlivewire', compact('homeworklist'));
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': web_homework' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
