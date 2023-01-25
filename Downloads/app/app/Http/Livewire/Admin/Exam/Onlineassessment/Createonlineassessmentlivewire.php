<?php

namespace App\Http\Livewire\Admin\Exam\Onlineassessment;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\Subject;
use App\Models\Admin\Settings\Onlineassessment\Mapboard;
use App\Models\Admin\Settings\Onlineassessment\Mapclass;
use App\Models\Admin\Settings\Onlineassessment\Mapsubject;
use Http;
use Livewire\Component;

class Createonlineassessmentlivewire extends Component
{
    public $questionmodel = false;
    public $configuremodal = false;
    public $subjectlist, $subject_id;
    public $board_uuid = null, $class_uuid = null, $subject_uuid = null, $searchterm = null;
    public $template, $assessmenttemplate, $assessmentquestion;
    public $classmaster, $section;
    public $class_id;
    public $page = 1, $current_page, $total_pages;
    protected $listeners = ['closeconfiguremodel'];

    public function mount()
    {
        $this->classmaster = Classmaster::where('active', true)->get();
        $this->subjectlist = Subject::where('active', true)->get();
    }

    public function updatedClassid()
    {
        if ($this->class_id && is_numeric($this->class_id)) {
            $this->class_uuid = Mapclass::find($this->class_id)->mapclass_uuid;
            if ($this->class_uuid == null) {
                $this->class_id = "";
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Class Not Mapped Yet']);
            }
        } else {
            $this->class_uuid = null;
        }
    }

    public function updatedSubjectid()
    {
        if ($this->subject_id && is_numeric($this->subject_id)) {
            $this->subject_uuid = Mapsubject::find($this->subject_id)->mapsubject_uuid;
            if ($this->subject_uuid == null) {
                $this->subject_id = "";
                $this->dispatchBrowserEvent('warningtoast', ['message' => 'Subject Not Mapped Yet']);
            }
        } else {
            $this->subject_uuid = null;
        }
    }

    public function getassessmentquestion($assessmenttemplateuuid)
    {
        $response = Http::post(config('archive.online_assessment.path') . '/getquestion', [
            'key' => config('archive.online_assessment.key'),
            'assessmenttemplateuuid' => $assessmenttemplateuuid,
        ]);
        $response = json_decode($response->body());
        $response = collect($response);
        $question = sizeof($response);
        return $question;
    }

    public function openmodelquestions($assessmenttemplateuuid)
    {
        $response = Http::post(config('archive.online_assessment.path') . '/getquestion', [
            'key' => config('archive.online_assessment.key'),
            'assessmenttemplateuuid' => $assessmenttemplateuuid,
        ]);
        $response = json_decode($response->body());

        $this->assessmentquestion = $response;
        $this->assessmenttemplate = $this->template->where('uuid', $assessmenttemplateuuid);
        $this->assessmenttemplate = $this->assessmenttemplate->flatMap(function ($values) {
            return array_map(null, $values);
        });
        $this->questionmodel = true;
    }

    public function closequestions()
    {
        $this->questionmodel = false;
    }

    public function openconfiguremodel()
    {
        $this->configuremodal = true;
        $this->questionmodel = false;
    }

    public function closeconfiguremodel($configuremodal)
    {
        $this->configuremodal = $configuremodal;
    }

    public function nextpage()
    {
        $this->page += 1;
    }

    public function perv()
    {
        $this->page -= 1;
    }

    public function render()
    {
        $mapboard = Mapboard::where('active', true)->get();
        if (sizeof($mapboard) > 0) {
            $this->board_uuid = $mapboard->first()->mapboard_uuid;
            $response = Http::post(config('archive.online_assessment.path') . '/gettemplate', [
                'key' => config('archive.online_assessment.key'),
                'boarduuid' => $this->board_uuid,
                "searchterm" => $this->searchterm,
                "classmasteruuid" => $this->class_uuid ? $this->class_uuid : null,
                "subjectuuid" => $this->subject_uuid ? $this->subject_uuid : null,
                "page" => $this->page,
            ]);
            if ($response->successful()) {
                $response = json_decode($response->body());
                $this->total_pages = $response->pagination->total_pages;
                $this->current_page = $response->pagination->current_page;
                $this->template = collect($response->assessmenttemplate);
            } else {
                $this->template = null;
            }

        }

        return view('livewire.admin.exam.onlineassessment.createonlineassessmentlivewire');
    }
}
