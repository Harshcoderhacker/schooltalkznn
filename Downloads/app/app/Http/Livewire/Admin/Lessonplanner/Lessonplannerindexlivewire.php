<?php

namespace App\Http\Livewire\Admin\Lessonplanner;

use App\Models\Admin\Lessonplanner\Lesson;
use Livewire\Component;

class Lessonplannerindexlivewire extends Component
{
    public function render()
    {
        $dueclasses = Lesson::where('is_completed', false)->get();
        return view('livewire.admin.lessonplanner.lessonplannerindexlivewire', compact('dueclasses'));
    }
}
