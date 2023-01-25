<?php

namespace App\Http\Livewire\Admin\Accounts\Feestudentinfo;

use App\Models\Admin\Accounts\Fee\Feeassignstudent;
use App\Models\Admin\Accounts\Fee\Feestudentpayment;
use App\Models\Admin\Settings\Feesetting\Feediscount;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;

class Feestudentinfoindexlivewire extends Component
{
    use WithFileUploads;

    public $student, $feediscount, $feeassignstudent;
    public $isModalFormOpen = false;
    public $feeassignstudentlist;
    public $feemaster_id, $academicyear_id, $classmaster_id, $section_id, $student_id, $aparent_id, $feediscount_id, $amount_to_pay,
    $due_amount, $payment_mode, $discount_amount, $remarks;
    public $total_paid_amount = 0;
    public $paying_amount = null;
    public $payment_document = null;

    protected function rules()
    {
        return [
            'feemaster_id' => 'required|integer',
            'feeassignstudent_id' => 'required|integer',
            'academicyear_id' => 'required|integer',
            'classmaster_id' => 'required|integer',
            'section_id' => 'required|integer',
            'student_id' => 'required|integer',
            'aparent_id' => 'required|integer',
            'feediscount_id' => 'nullable',
            'amount_to_pay' => 'required|numeric',
            'paying_amount' => 'required|numeric',
            'due_amount' => 'required|numeric',
            'discount_amount' => 'nullable',
            'total_paid_amount' => 'required|numeric',
            'payment_mode' => 'required|integer',
            'type' => 'required|integer',
            'payment_document' => 'nullable|mimes:jpg,jpeg,png,pdf,docx,doc|max:10240',
            'remarks' => 'nullable|max:250',

        ];
    }

    protected function messages()
    {
        return [
            'paying_amount.required' => 'Amount cannot be empty',
            'payment_mode.lte' => 'Amount should not exceed',
            'payment_document.mimes' => 'Document should be in jpg,jpeg,png,pdf,docx,doc',
            'payment_document.max' => 'Document should not exceed 10mb.',
            'remarks.max:250' => 'Notes should be max 250 characters',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Student $student)
    {
        $this->student = $student;
        $this->feediscount = Feediscount::all();
        $this->feeassignstudentlist = Feeassignstudent::where('student_id', $student->id)
            ->where('is_selected', true)->get();
    }

    public function payfeeopenformModal(Feeassignstudent $feeassignstudent)
    {
        $this->feeassignstudent = $feeassignstudent;
        $this->feemaster_id = $feeassignstudent->feemaster_id;
        $this->feeassignstudent_id = $feeassignstudent->id;
        $this->academicyear_id = $feeassignstudent->academicyear_id;
        $this->classmaster_id = $feeassignstudent->classmaster_id;
        $this->section_id = $feeassignstudent->section_id;
        $this->student_id = $feeassignstudent->student_id;
        $this->aparent_id = $feeassignstudent->aparent_id;
        $this->amount_to_pay = $feeassignstudent->due_amount;
        $this->type = 1;
        $this->isModalFormOpen = true;
    }

    public function payfeecloseFormModal()
    {
        $this->feemaster_id = '';
        $this->academicyear_id = '';
        $this->classmaster_id = '';
        $this->section_id = '';
        $this->student_id = '';
        $this->aparent_id = '';
        $this->feediscount_id = null;
        $this->amount_to_pay = null;
        $this->paying_amount = null;
        $this->due_amount = null;
        $this->total_paid_amount = null;
        $this->payment_mode = '';
        $this->payment_document = '';
        $this->remarks = '';
        $this->resetErrorBag();
        $this->isModalFormOpen = false;
    }

    public function payfeestore()
    {
        $validated = $this->validate();
        try {
            DB::beginTransaction();

            if ($this->payment_document != null) {
                $fileName = 'Student-Fee-Doc' . time() . '.' . $this->payment_document->getClientOriginalExtension();
                $this->payment_document = $this->payment_document->storeAs('Account/Fee/Student/Paymentdoucment/', $fileName);
            }

            Feestudentpayment::create($validated);
            $this->feeassignstudent->update([
                'total_paid_amount' => $this->feeassignstudent->total_paid_amount + $validated['total_paid_amount'],
                'due_amount' => $validated['due_amount'],
                'is_lock' => true,
            ]);

            Helper::trackmessage(auth()->user(), 'Admin fee student pay', 'admin_web_fee_student_pay', session()->getId(), 'WEB');
            DB::commit();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Fee Paid successfully']);

            redirect()->route('feestudentinfo', $this->feeassignstudent->student_id);

        } catch (Exception $e) {
            $this->exceptionerror('admin_web_fee_student_pay', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('admin_web_fee_student_pay', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('admin_web_fee_student_pay', 'three', $e);
        }
    }

    public function calculatetotalpaid()
    {

        if ($this->feediscount_id != null) {
            $this->discount_amount = Feediscount::find($this->feediscount_id)?->amount;
            $this->validate(
                ['paying_amount' => 'lte:' . $this->amount_to_pay - $this->discount_amount,
                ],
                [
                    'paying_amount.lte' => 'Amount should not exceed ' . $this->amount_to_pay - $this->discount_amount,
                ]);
            $this->total_paid_amount = $this->amount_to_pay - $this->discount_amount;
            $this->due_amount = $this->amount_to_pay - ($this->paying_amount + $this->discount_amount);
        } else {
            $this->discount_amount = 0;
            $this->validate(
                ['paying_amount' => 'lte:' . $this->amount_to_pay,
                ],
                [
                    'paying_amount.lte' => 'Amount should not exceed ' . $this->amount_to_pay,
                ]);
            $this->total_paid_amount = $this->paying_amount;
            $this->due_amount = $this->amount_to_pay - $this->paying_amount;
        }
    }

    public function Updatedfeediscountid()
    {
        $this->paying_amount = null;
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_fee_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }

    public function render()
    {
        return view('livewire.admin.accounts.feestudentinfo.feestudentinfoindexlivewire');
    }
}
