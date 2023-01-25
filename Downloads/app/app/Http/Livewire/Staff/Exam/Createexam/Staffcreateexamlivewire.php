<?php

namespace App\Http\Livewire\Staff\Exam\Createexam;

use App\Models\Admin\Exam\Offlineexam\Exam;
use App\Models\Admin\Exam\Offlineexam\Examstudentlist;
use App\Models\Admin\Exam\Offlineexam\Examstudentsubjectlist;
use App\Models\Admin\Exam\Offlineexam\Examsubject;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Staffcreateexamlivewire extends Component
{
    public $classteacher, $user;
    public $show = 1;
    public $validatedconfigureclass;
    public $name, $classmaster_name, $section_name;
    public $classmaster_id, $section, $exam_id, $academicyear_id;
    public $subjectlist = [], $subject = [], $mark, $total_mark;
    public $datelist = [], $date, $subject_id, $start_time, $end_time;
    public $selectedsubject = [];

    public function mount($exam_id = null, $show)
    {
        if ($exam_id) {
            $this->exam_id = $exam_id;
            $exam = Exam::find($exam_id);
            $this->name = $exam->name;
            $this->classmaster_id = $exam->classmaster_id;
            $this->section = $exam->section;
            $this->academicyear_id = $exam->academicyear_id;
            $this->subject = Assignsubject::where('active', true)
                ->where('classmaster_id', $this->classmaster_id)
                ->whereIn('section_id', $this->section)
                ->get();

            $this->examsubject = Examsubject::where('exam_id', $exam_id)->get();
            foreach ($this->examsubject as $key => $eachexamsubject) {
                $this->subjectlist[$key] = [
                    'subject_id' => $eachexamsubject->subject_id,
                    'mark' => $eachexamsubject->mark,
                    'date' => Carbon::parse($eachexamsubject->examdate)->format('Y-m-d'),
                    'start_time' => $eachexamsubject->start->toTimeString(),
                    'end_time' => $eachexamsubject->end->toTimeString(),
                ];
            }
            foreach ($this->subjectlist as $key => $value) {
                $subjectselected = Subject::find($value['subject_id'])->name;
                $this->selectedsubject = $subjectselected;
                $this->subjectlist[$key] = array_merge($value, ['subject_name' => $subjectselected]);
            }
            $this->calculatemark();

            $this->classmaster_name = $exam->classmaster->name;
            $this->section_name = Section::whereIn('id', $this->section)->pluck('name')->implode(', ');

        }

        $this->user = auth()->guard('staff')->user();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->classteacher = Assignsubject::where('staff_id', $this->user->id)
            ->where('is_classteacher', true)
            ->get();
        $this->show = $show;

        $this->calculatemark();

        $this->exam_id = $exam_id;
    }

    public function validateconfigureclass()
    {
        $this->validatedconfigureclass = $this->validate(
            ['name' => 'required|min:3|max:35',
                'classmaster_id' => 'required',
                'section' => 'required',
            ],
            [
                'name.required' => 'Name cannot be empty',
                'name.min' => 'Name should have minimum 3 letters',
                'name.max' => 'Name should not exceed 35 letters',
                'classmaster_id.required' => 'Select Class',
                'section.required' => 'Select Section',

            ]);
        $this->section_name = Section::whereIn('id', $this->section)->pluck('name')->implode(', ');
        $this->validatedconfigureclass['academicyear_id'] = $this->academicyear_id;
        $this->subject = Assignsubject::where('active', true)
            ->where('classmaster_id', $this->classmaster_id)
            ->whereIn('section_id', $this->section)
            ->get();

        if ($this->exam_id == null) {
            $this->subjectlist[] = [
                'subject_id' => null,
                'mark' => null,
            ];
        }
        $this->show = 2;
    }

    public function validatesubjectmark()
    {
        $this->validate([
            'subjectlist.*.subject_id' => 'required|not_in:0',
            'subjectlist.*.mark' => 'required',
        ], [
            'subjectlist.*.subject_id.required' => 'Select subject',
            'subjectlist.*.subject_id.not_in' => 'Select subject',
            'subjectlist.*.mark.required' => 'Mark cannot be empty.',

        ]);
        foreach ($this->subjectlist as $key => $value) {
            $subjectselected = Subject::find($value['subject_id'])->name;
            $this->selectedsubject = $subjectselected;
            $this->subjectlist[$key] = array_merge($value, ['subject_name' => $subjectselected]);
        }
        $this->show = 3;
    }

    public function validateexamschedule()
    {
        $this->validate([
            'subjectlist.*.date' => 'required|after:' . Carbon::yesterday(),
            'subjectlist.*.start_time' => 'required',
            'subjectlist.*.end_time' => 'required|after:subjectlist.*.start_time',
        ], [
            'subjectlist.*.date.required' => 'need date',
            'subjectlist.*.date.after' => 'Invalid date',
            'subjectlist.*.start_time.required' => 'Enter Start Time',
            'subjectlist.*.end_time.required' => 'Entetr End Time',
            'subjectlist.*.end_time.after' => 'Invalid Time',
        ]);
        foreach ($this->subjectlist as $key => $value) {
            $selecteddate = $value['date'];
            $selectedstart = $value['start_time'];
            $selectedend = $value['end_time'];
            $this->subjectlist[$key] = array_merge($this->subjectlist[$key], ['date' => $selecteddate]);
            $this->subjectlist[$key] = array_merge($this->subjectlist[$key], ['start_time' => $selectedstart]);
            $this->subjectlist[$key] = array_merge($this->subjectlist[$key], ['end_time' => $selectedend]);
        }
        $this->show = 4;
    }

    public function submitexam()
    {
        try {
            DB::beginTransaction();

            $exam = $this->createoreditexam();
            $this->createoreditsubjectmark($exam);
            $this->createoreditschedule($exam);

            Helper::trackmessage(auth()->guard('staff')->user(), 'staff fee Create/Edit', 'staff_web_fee_create/edit', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Exam Created Successfully!']);
            redirect()->route('staffcreateexamindex');

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function createoreditexam()
    {
        if ($this->exam_id) {
            $exam = Exam::find($this->exam_id);
            $exam->update($this->validatedconfigureclass);
        } else {
            $exam = Exam::create($this->validatedconfigureclass);
        }
        return $exam;
    }

    public function createoreditsubjectmark($exam)
    {
        foreach ($this->subjectlist as $eachsubject) {
            Examsubject::updateOrCreate([
                'exam_id' => $exam->id,
                'subject_id' => $eachsubject['subject_id'],
            ], [
                'mark' => $eachsubject['mark'],
                'examdate' => $eachsubject['date'],
                'start' => $eachsubject['start_time'],
                'end' => $eachsubject['end_time'],
            ]);
        }
    }

    public function createoreditschedule($exam)
    {
        if ($exam->id) {
            Examstudentlist::where('exam_id', $exam->id)->delete();
            Examstudentsubjectlist::where('exam_id', $exam->id)->delete();
        }

        $studentlist = Student::isaccountactive()
            ->where('classmaster_id', $this->classmaster_id)
            ->whereIn('section_id', $this->section)
            ->get();

        foreach ($studentlist as $eachstudent) {
            $examstudentlist = Examstudentlist::create([
                'student_id' => $eachstudent->id,
                'exam_id' => $exam->id,
                'classmaster_id' => $eachstudent->classmaster_id,
                'section_id' => $eachstudent->section_id,
            ]);

            foreach ($this->subjectlist as $eachsubject) {
                $examstudentlist->examstudentsubjectlist()->create([
                    'exam_id' => $exam->id,
                    'subject_id' => $eachsubject['subject_id'],
                ]);
            }
        }
    }

    public function addsubject()
    {
        $this->subjectlist[] = [
            'subject_id' => '',
            'mark' => '',
        ];
        $this->calculatemark();
    }

    public function removesubject($key)
    {
        unset($this->subjectlist[$key]);
        $this->calculatemark();
    }

    public function calculatemark()
    {
        $subject_mark = collect($this->subjectlist)->pluck('mark')->toArray();
        $this->total_mark = array_sum($subject_mark);
    }

    public function back($step)
    {
        $this->show = $step;
    }

    public function hydrate()
    {
        $this->emit('loadSelect2Hydrate');
    }

    public function render()
    {
        return view('livewire.staff.exam.createexam.staffcreateexamlivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

}
