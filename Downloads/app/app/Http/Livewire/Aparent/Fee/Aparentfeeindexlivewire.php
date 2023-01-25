<?php

namespace App\Http\Livewire\Aparent\Fee;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Settings\Integration\Paymentintegration;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;

class Aparentfeeindexlivewire extends Component
{
    public $student, $feeassignstudent, $paymentintegration;

    public function mount()
    {
        $this->student = Parenthelper::getstudentweb();
        $this->feeassignstudent = Feeassignstudent::where('student_id', $this->student->id)
            ->where('is_selected', true)->get();
        $this->paymentintegration = Paymentintegration::where('is_default', true)->first();
    }

    public function render()
    {
        return view('livewire.aparent.fee.aparentfeeindexlivewire');
    }
}
