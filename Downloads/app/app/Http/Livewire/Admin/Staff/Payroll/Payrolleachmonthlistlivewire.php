<?php

namespace App\Http\Livewire\Admin\Staff\Payroll;

use App\Mail\Payroll\Staffpayrollmail;
use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Miscellaneous\Helper;
use App\Models\Miscellaneous\Numbertowords;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithPagination;
use PDF;

class Payrolleachmonthlistlivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 10;

    public $payrollid, $showpayrolleachmonth, $staff;

    public $staff_name, $month_year, $net_salary;

    public $payment_date, $description, $payment_mode, $is_paid;

    public $showPaysalarymodal = false;
    public $showDownloadpayslipmodal = false;

    public $bulkselected = [];
    public $bulkselectedchecked = true;

    protected function rules()
    {
        return [
            'payment_date' => 'required|date',
            'payment_mode' => 'required|integer',
            'description' => 'nullable',
        ];
    }

    protected function messages()
    {
        return [
            'payment_mode.integer' => 'Field is required',
        ];
    }

    public function mount($payrollid)
    {
        $this->payrollid = $payrollid;
    }

    public function openPaysalarymodal()
    {
        $this->showPaysalarymodal = true;
    }

    public function closePaysalarymodal()
    {
        $this->resetErrorBag();
        $this->showPaysalarymodal = false;
    }

    public function openDownloadpayslipmodal()
    {
        $this->showDownloadpayslipmodal = true;
    }

    public function closeDownloadpayslipmodal()
    {
        $this->showDownloadpayslipmodal = false;
    }

    public function generatebulkpayslip()
    {
        DB::beginTransaction();
        foreach ($this->bulkselected as $key => $value) {
            $payrolleachmonth = Payrolleachmonth::find($value);

            $staff = Staff::find($payrolleachmonth->staff_id);

            $totalearning = $staff->earnings->sum('value');
            $totaldeduction = $staff->deductions->sum('value');
            $gross_salary = $totalearning + $staff->basic_salary - $totaldeduction;
            $tax = $payrolleachmonth->tax ? $payrolleachmonth->tax : 0;
            $net_salary = $gross_salary - $tax;

            $payrolleachmonth->update([
                'earning' => $totalearning,
                'deduction' => $totaldeduction,
                'gross_salary' => $gross_salary,
                'tax' => $tax,
                'net_salary' => $net_salary,
                'earning_breakup' => json_encode($staff->earnings->toArray()),
                'deduction_breakup' => json_encode($staff->deductions->toArray()),
                'is_generated' => true,
            ]);

        }
        Helper::trackmessage(auth()->user(), 'Admin Bulk Payroll Generated', 'admin_web_generatebulkpayslip', session()->getId(), 'WEB');

        DB::commit();
        $this->bulkselected = [];
        $this->dispatchBrowserEvent('successtoast', ['message' => 'Bulk Payroll Generated Successfully !']);
    }

    public function editpaysalary(Payrolleachmonth $payrolleachmonth)
    {
        $this->payrolleachmonthid = $payrolleachmonth->id;
        $this->staff_name = $payrolleachmonth->name;
        $this->month_year = Carbon::parse($payrolleachmonth->month_string)->format('M-Y');
        $this->net_salary = $payrolleachmonth->net_salary;
        $this->payment_date = $payrolleachmonth->payment_date;
        $this->payment_mode = $payrolleachmonth->payment_mode;
        $this->description = $payrolleachmonth->payment_description;
        $this->is_paid = $payrolleachmonth->is_paid;

        $this->showPaysalarymodal = true;
    }

    public function updatepayrolleachmonth()
    {
        try {
            DB::beginTransaction();
            $validate = $this->validate();
            $user = auth()->user();
            Payrolleachmonth::find($this->payrolleachmonthid)
                ->update([
                    'payment_date' => $validate['payment_date'],
                    'payment_mode' => $validate['payment_mode'],
                    'payment_description' => $validate['description'],
                    'is_paid' => true,
                    'payment_doneby' => $user->name,
                ]);
            Helper::trackmessage($user, 'Admin PaySalary', 'admin_web_paysalary', session()->getId(), 'WEB');

            DB::commit();
            $this->closePaysalarymodal();
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Payment Added !']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function viewanddownloadpayslip(Payrolleachmonth $payrolleachmonth)
    {
        $this->showpayrolleachmonth = $payrolleachmonth;
        $staffdetailsdata = json_decode($payrolleachmonth->staff_details);
        $this->staff = collect($staffdetailsdata[0]);
        $this->openDownloadpayslipmodal();
    }

    public function downloadpayslip()
    {
        $payrolleachmonth = $this->showpayrolleachmonth;
        $staff_details = json_decode($payrolleachmonth->staff_details);
        $earning_breakup = json_decode($payrolleachmonth->earning_breakup);
        $deduction_breakup = json_decode($payrolleachmonth->deduction_breakup);
        $rupees = Numbertowords::Numbertowords($payrolleachmonth->net_salary);

        $pdf = PDF::loadView('admin.staff.payroll.pdf.payrolleachmonth',
            compact('payrolleachmonth', 'staff_details', 'earning_breakup', 'deduction_breakup', 'rupees'))
            ->setPaper('a4', 'landscape')
            ->output();

        $this->dispatchBrowserEvent('successtoast', ['message' => 'Payslip Download Intiated']);
        return response()->streamDownload(fn() => print($pdf), 'payslip.pdf');

    }
    public function sendmailpayslip()
    {
        try {
            Mail::to('preparenext@gmail.com')->send(new Staffpayrollmail($this->showpayrolleachmonth->uuid));
            $this->dispatchBrowserEvent('successtoast', ['message' => 'Mail Sent Successfully']);
        } catch (Exception $e) {
            $this->dispatchBrowserEvent('successtoast', ['message' => $e->getMessage()]);
        }
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function updatepagination()
    {
        $this->resetPage();
    }

    public function render()
    {
        $payrolleachmonth = Payrolleachmonth::query()
            ->where('payroll_id', $this->payrollid)
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.staff.payroll.payrolleachmonthlistlivewire', [
            'payrolleachmonth' => $payrolleachmonth,
        ]);
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_section_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
