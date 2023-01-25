<?php

namespace App\Http\Livewire\Staff\Exam\Onlineassessment;

use App\Models\Admin\Exam\Onlineassessment\Onlineassessment;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentquestion;
use App\Models\Admin\Exam\Onlineassessment\Onlineassessmentstudentlist;
use App\Models\Admin\Settings\Academicsetting\Assignsubject;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Staffconfigureonlineassessmentlivewire extends Component
{
    public $user;
    public $assessmenttemplate, $assignsubject;
    public $classmaster_id, $section, $academicyear_id;
    public $start_date, $end_date;
    public $assigntype, $assessmentquestion;
    public $sectionlist = [];

    public function mount($assessmenttemplate, $assessmentquestion)
    {
        $this->user = auth()->guard('staff')->user();
        $this->assessmentquestion = $assessmentquestion;
        $this->assignsubject = Assignsubject::where('staff_id', $this->user->id)
            ->get();
        $this->academicyear_id = App::make('generalsetting')->academicyear_id;
        $this->assessmenttemplate = $assessmenttemplate;
    }

    public function closeconfigure()
    {
        $this->emit('closeconfiguremodel', false);
        $this->sectionlist = [];
        $this->classmaster_id = '';
        $this->assigntype = '';
    }

    public function updatedClassmasterid()
    {
        $this->sectionlist = '';
        if ($this->classmaster_id && is_numeric($this->classmaster_id)) {
            $this->sectionlist = $this->assignsubject->where('classmaster_id', $this->classmaster_id);
        } else {
            $this->sectionlist = [];
        }
    }

    public function createassessment()
    {
        $subject = Mapsubject::where('mapsubject_uuid', $this->assessmenttemplate['subject'])->first();
        $mapclass = Mapclass::where('mapclass_uuid', $this->assessmenttemplate['classmaster'])->first();
        if ($mapclass != null && $subject != null) {
            $validated = $this->validate([
                'classmaster_id' => 'required',
                'section' => 'required',
                'assigntype' => 'required|integer',
            ]);
            if ($this->assigntype == 2) {
                $this->validate(
                    [
                        'start_date' => 'required|after_or_equal:' . Carbon::today(),
                        'end_date' => 'required|after:' . $this->start_date,
                    ]);
            }
            $validated['start_date'] = $this->start_date;
            $validated['end_date'] = $this->end_date;
            $validated['academicyear_id'] = $this->academicyear_id;
            $validated['subject_id'] = $subject->subject_id;
            $validated['name'] = $this->assessmenttemplate['name'];
            $validated['total_mark'] = (sizeof($this->assessmentquestion) * config('archive.online_assessment.mark'));

            $img = $this->assessmenttemplate['image'];
            $validated['image'] = basename($this->assessmenttemplate['image']);

            Storage::disk('public')->put('onlineassessment/' . $validated['image'], file_get_contents($img), 'public');
            if ($mapclass->classmaster_id == $this->classmaster_id) {
                try {
                    DB::beginTransaction();

                    $onlineassessment_id = Onlineassessment::create($validated)->id;
                    foreach ($this->assessmentquestion as $eachonlineassessmentquestion) {
                        Onlineassessmentquestion::create([
                            'onlineassessment_id' => $onlineassessment_id,
                            'question' => $eachonlineassessmentquestion['question'],
                            'option_one' => $eachonlineassessmentquestion['option_one'],
                            'option_two' => $eachonlineassessmentquestion['option_two'],
                            'option_three' => $eachonlineassessmentquestion['option_three'],
                            'option_four' => $eachonlineassessmentquestion['option_four'],
                            'answer' => $eachonlineassessmentquestion['answer'],
                        ]);
                    }
                    $studentlist = Student::isaccountactive()
                        ->where('academicyear_id', $this->academicyear_id)
                        ->where('classmaster_id', $this->classmaster_id)
                        ->whereIn('section_id', $this->section)
                        ->get();

                    foreach ($studentlist as $eachstudent) {
                        $onlineassessmentstudentlist = Onlineassessmentstudentlist::create([
                            'student_id' => $eachstudent->id,
                            'onlineassessment_id' => $onlineassessment_id,
                            'classmaster_id' => $eachstudent->classmaster_id,
                            'section_id' => $eachstudent->section_id,
                        ]);
                    }
                    Helper::trackmessage($this->user, 'Staff Online Assessment Create/Edit', 'staff_web_online_assessmentcreate/edit', session()->getId(), 'WEB');
                    DB::commit();
                    $this->emit('closeconfiguremodel', false);
                    $this->dispatchBrowserEvent('successtoast', ['message' => 'Exam Created Successfully!']);
                    redirect()->route('staffonlineassessment');

                } catch (Exception $e) {
                    $this->exceptionerror('createorupdate', 'one', $e);
                } catch (QueryException $e) {
                    $this->exceptionerror('createorupdate', 'two', $e);
                } catch (PDOException $e) {
                    $this->exceptionerror('createorupdate', 'three', $e);
                }
            } else {
                $this->dispatchBrowserEvent('warningtoast', ['message' => "Assessment not Created! Can't Assign Other Class Subject"]);
                $this->closeconfiguremodel();
            }
        } else {
            if ($mapclass == null && $subject == null) {
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Assessment not Created! Class and Subject Not Mapped Yet']);
                $this->closeconfiguremodel();
            } elseif ($subject == null) {
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Assessment not Created! Subject Not Mapped Yet']);
                $this->closeconfiguremodel();
            } else {
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Assessment not Created! Class Not Mapped Yet']);
                $this->closeconfiguremodel();
            }
        }
    }

    public function render()
    {
        return view('livewire.staff.exam.onlineassessment.staffconfigureonlineassessmentlivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_promote_student' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
