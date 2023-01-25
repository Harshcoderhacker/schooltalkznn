<?php

namespace App\Http\Livewire\Admin\Accounts\Fee;

use App\Models\Admin\Accounts\Fee\Feemaster;
use App\Models\Admin\Settings\Academicsetting\Section;
use Livewire\Component;

class Createfeeindexlivewire extends Component
{
    public $feemasterdata, $feemaster, $feemastersection, $paidstudent, $unpaidstudent;

    public $showfeedetailsmodal = false;

    public function mount()
    {
        $this->feemasterdata = Feemaster::with('feemasterparticular', 'feemasterparticular.feeparticular', 'feestudentpayment')->get();

    }

    public function openfeedetailsmodal(Feemaster $feemaster)
    {
        $this->feemaster = $feemaster;
        $this->feemastersection = Section::whereIn('id', $feemaster->section)->pluck('name')->implode(', ');
        $this->paidstudent = $feemaster->feeassignstudent->where('due_amount', 0)->count();
        $this->unpaidstudent = $feemaster->feeassignstudent->where('due_amount', '<>', 0)->count();
        $this->showfeedetailsmodal = true;
    }

    public function closefeedetailsemodal()
    {
        $this->showfeedetailsmodal = false;
    }

    public function render()
    {
        return view('livewire.admin.accounts.fee.createfeeindexlivewire');
    }
}
