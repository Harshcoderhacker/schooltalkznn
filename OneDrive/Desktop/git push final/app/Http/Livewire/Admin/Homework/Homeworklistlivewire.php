<?php

namespace App\Http\Livewire\Admin\Homework;

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class Homeworklistlivewire extends Component
{

    public $user, $platform;
    public $homework, $marks;
    public $homeworklist_id;
    public $is_chat = false;

    protected $listeners = ['isChat'];

    public function isChat($is_chat, $homeworklist_id)
    {
        $this->is_chat = $is_chat;
        $this->homeworklist_id = $homeworklist_id;
    }

    public function back()
    {
        $this->is_chat = false;

    }

    public function mount($platform, $homework)
    {
        $this->platform = $platform;
        $this->homework = Homework::where('uuid', $homework)->first();
        if ($platform == "admin") {
            $this->user = auth()->user();
        } elseif ($platform == "staff") {
            $this->user = auth()->guard('staff')->user();
        }
    }

    public function downloadevaluationreport()
    {
        $homework = $this->homework;
        $homeworklist = Homeworklist::where('homework_id', $this->homework->id)->get();
        $percentage = 0;

        if ($this->homework->homeworklist->where('homework_status', true)->count() != 0) {
            $percentage = round((($this->homework->homeworklist->where('homework_status', true)->count()) / ($this->homework->homeworklist->count())) * 100);
        }

        $pdf = Pdf::loadView('admin.homework.pdf.evaluationreport',
            compact('homework', 'homeworklist', 'percentage'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Evaluation Report Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'Evaluationreport.pdf');
    }

    public function render()
    {
        return view('livewire.admin.homework.homeworklistlivewire');
    }
}
