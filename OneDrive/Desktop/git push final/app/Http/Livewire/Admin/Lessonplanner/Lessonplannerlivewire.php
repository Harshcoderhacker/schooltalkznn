<?php

namespace App\Http\Livewire\Admin\Lessonplanner;

use App\Models\Admin\Lessonplanner\Lesson;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Lessonplannerlivewire extends Component
{
    use WithPagination;
    public $classmasterid, $sectionid, $assignsubjectid, $lessonid;
    public $classmasterlist, $sectionlist, $classmaster, $section;
    public $assignsubject = [];
    public $paginationlength = 10;
    public $isNewlessonModalFormOpen = false;
    public $isAddlessontopicModalFormOpen = false;
    public $isMarkcompleteModalFormOpen = false;
    public $markcompletionlessonid = null;
    public $user;
    public $markcompletion_lesson;

    public $lessonform = [
        'name' => '',
        'start_date' => '',
        'due_date' => '',
    ];
    public $markcompletion = [
        'is_completed' => 0,
        'start_date' => '',
        'due_date' => '',
    ];

    protected $rules = [
        'lessonform.name' => 'required',
        'lessonform.start_date' => 'required',
        'lessonform.due_date' => 'required',
    ];

    protected $messages = [
        'lessonform.name.required' => 'Name is required.',
        'lessonform.start_date.required' => 'Start date is required.',
        'lessonform.due_date.required' => 'Due date is required.',
    ];

    public function mount($platform, $duelesson_id)
    {
        if ($duelesson_id != null) {
            $duelesson = Lesson::find($duelesson_id);
            $this->classmasterid = $duelesson->classmaster_id;
            $this->sectionlist = Classmaster::find($this->classmasterid)?->section;
            $this->sectionid = $duelesson->section_id;
            $this->assignsubject = Assignsubject::where('classmaster_id', $this->classmasterid)->where('section_id', $this->sectionid)->get();
            $this->assignsubjectid = $duelesson->assignsubject_id;
            $this->classmaster = Classmaster::find($this->classmasterid);
            $this->section = Section::find($this->sectionid);
        } else {
            $this->sectionlist = [];
        }
        $this->classmasterlist = Classmaster::where('active', true)->get();
        if ($platform == "admin") {
            $this->user = auth()->user();
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
        }
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

    public function updatedSectionid()
    {
        $this->assignsubjectid = '';
        if ($this->classmasterid && $this->sectionid) {
            $this->assignsubject = Assignsubject::where('classmaster_id', $this->classmasterid)->where('section_id', $this->sectionid)->get();
            $this->classmaster = Classmaster::find($this->classmasterid);
            $this->section = Section::find($this->sectionid);
        } else {
            $this->assignsubject = [];
        }
    }

    public function newlessonopenformModal()
    {
        $this->isNewlessonModalFormOpen = true;
    }

    public function newlessoncloseformModal()
    {
        $this->isNewlessonModalFormOpen = false;
        $this->resefields();
    }

    public function addlessontopicopenformModal()
    {
        $this->isAddlessontopicModalFormOpen = true;
    }

    public function addlessontopiccloseformModal()
    {
        $this->isAddlessontopicModalFormOpen = false;
    }

    public function markcompleteopenformModal(Lesson $lesson)
    {
        $this->markcompletion_lesson = $lesson;
        $this->markcompletionlessonid = $lesson->id;
        $this->markcompletion = [
            'is_completed' => $lesson->is_completed,
            'start_date' => $lesson->start_date,
            'due_date' => $lesson->due_date,
        ];
        $this->isMarkcompleteModalFormOpen = true;
    }

    public function markcompletecloseformModal()
    {
        $this->isMarkcompleteModalFormOpen = false;
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function newlessonstore()
    {
        $validated_lesson = $this->validate();
        try {
            DB::beginTransaction();
            if (!empty($this->lessonid)) {
                $lesson = Lesson::find($this->lessonid);
                $lesson->update($validated_lesson['lessonform']);
            } else {
                $validated_lesson['lessonform']['classmaster_id'] = $this->classmasterid;
                $validated_lesson['lessonform']['section_id'] = $this->classmasterid;
                $validated_lesson['lessonform']['assignsubject_id'] = $this->assignsubjectid;
                $validated_lesson['lessonform']['subject_id'] = Assignsubject::find($this->assignsubjectid)->subject_id;
                $this->user
                    ->lesson()
                    ->save(new Lesson($validated_lesson['lessonform']));
            }

            Helper::trackmessage(auth()->user(), 'Admin Lesson plan Create/Edit', 'admin_web_lessonplan_create/edit', session()->getId(), 'WEB');
            DB::commit();
            $this->resefields();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Lesson plan Created!']);
            // redirect()->route('adminplanlesson');

        } catch (Exception $e) {
            $this->exceptionerror('newlessonstore', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('newlessonstore', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('newlessonstore', 'three', $e);
        }
    }

    public function editlesson(Lesson $lesson)
    {
        $this->lessonid = $lesson->id;
        $this->lessonform = [
            'name' => $lesson->name,
            'start_date' => $lesson->start_date,
            'due_date' => $lesson->due_date,
        ];
    }

    public function deleteconfirm($lessonuuid)
    {
        $this->dispatchBrowserEvent('deletetoast', ['uuid' => $lessonuuid]);
    }

    public function delete($lessonuuid)
    {
        try {
            DB::beginTransaction();

            Lesson::where('uuid', $lessonuuid)->delete();
            Helper::trackmessage(auth()->user(), 'Admin Lesson Delete', 'admin_web_lesson_delete', session()->getId(), 'WEB');

            DB::commit();
            $this->resefields();
            $this->dispatchBrowserEvent('deletemsg', ['message' => 'Lesson Deleted!']);

        } catch (Exception $e) {
            $this->exceptionerror('deletelesson', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('deletelesson', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('deletelesson', 'three', $e);
        }
    }

    public function markcompletionstore()
    {
        $validate_markCompletion = $this->validate([
            'markcompletion.start_date' => 'required',
            'markcompletion.due_date' => 'required',
            'markcompletion.is_completed' => 'required',
        ],
            [
                'markcompletion.is_completed.required' => 'This field is required.',
                'markcompletion.start_date.required' => 'Start date is required.',
                'markcompletion.due_date.required' => 'Due date is required.',
            ]);
        try {
            DB::beginTransaction();
            if (!empty($this->markcompletionlessonid)) {
                $lesson = Lesson::find($this->markcompletionlessonid);
                $lesson->update($validate_markCompletion['markcompletion']);
            }
            Helper::trackmessage(auth()->user(), 'Admin Lesson Mark Completion', 'admin_web_lessonmark_completion', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Lesson Mark Completed!']);
            $this->isMarkcompleteModalFormOpen = false;

        } catch (Exception $e) {
            $this->exceptionerror('markcompletionstore', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('markcompletionstore', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('markcompletionstore', 'three', $e);
        }
    }

    public function resefields()
    {
        $this->lessonid = '';
        $this->lessonform = [
            'name' => '',
            'start_date' => '',
            'due_date' => '',
        ];
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_lessonplan_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        $lesson = Lesson::with('lessontopic')
            ->where(fn($query) => $query->where('classmaster_id', $this->classmasterid))
            ->where(fn($query) => $query->where('section_id', $this->sectionid))
            ->where(fn($query) => $query->where('assignsubject_id', $this->assignsubjectid))
            ->paginate($this->paginationlength)->onEachSide(1);
        $lessonlist = Lesson::where(fn($query) => $query->where('classmaster_id', $this->classmasterid))
            ->where(fn($query) => $query->where('section_id', $this->sectionid))
            ->where(fn($query) => $query->where('assignsubject_id', $this->assignsubjectid))->get();
        return view('livewire.admin.lessonplanner.lessonplannerlivewire', compact('lesson', 'lessonlist'));
    }
}
