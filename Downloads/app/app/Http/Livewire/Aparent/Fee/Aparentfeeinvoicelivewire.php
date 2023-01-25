<?php

namespace App\Http\Livewire\Aparent\Fee;

use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Parent\Parenthelper\Parenthelper;
use Livewire\Component;

class Aparentfeeinvoicelivewire extends Component
{
    public $student, $feestudentpayment;

    public function mount()
    {
        $this->student = Parenthelper::getstudentweb();
        $this->feestudentpayment = Feestudentpayment::where('student_id', $this->student->id)
            ->get();
    }

    public function render()
    {
        return view('livewire.aparent.fee.aparentfeeinvoicelivewire');
    }
}
