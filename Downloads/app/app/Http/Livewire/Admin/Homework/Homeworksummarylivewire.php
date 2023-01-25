<?php

namespace App\Http\Livewire\Admin\Homework;

use App\Models\Admin\Homework\Homework;
use App\Models\Admin\Homework\Homeworklist;
use Livewire\Component;
use Storage;

class Homeworksummarylivewire extends Component
{
    public $user, $platform;
    public $homework;

    protected $listeners = ['summaryrefresh' => '$refresh'];

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

    public function downloadhomeworkattachment()
    {
        return Storage::download($this->homework->attachment);
    }

    public function render()
    {
        $percentage = 0;

        if ($this->homework->homeworklist->where('homework_status', true)->count() != 0) {
            $percentage = round((($this->homework->homeworklist->where('homework_status', true)->count()) / ($this->homework->homeworklist->count())) * 100);
        }

        return view('livewire.admin.homework.homeworksummarylivewire', compact('percentage'));
    }
}
