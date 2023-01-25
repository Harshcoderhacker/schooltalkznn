<?php

namespace App\Http\Livewire\Admin\Staff\Payroll;

use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Admin\Staff\Payroll\Payrollearndeduct;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class Payrollgeneratelivewire extends Component
{
    public $staffpayroll, $staffdetails;

    public $no_of_days_present, $no_of_days_absent, $lop, $halfdays;

    public $staff;
    public $basic_salary, $total_earning, $total_deducton, $gross_salary, $tax, $net_salary;

    public $earning = [];
    public $deduction = [];

    public $toast = true;

    public function mount(Payrolleachmonth $staffpayrollid)
    {

        $this->staffpayroll = $staffpayrollid;
        $staffdetailsdata = json_decode($staffpayrollid->staff_details);
        $this->staffdetails = collect($staffdetailsdata[0]);
        $this->staffpayroll_generated = $staffpayrollid->is_generated;

        $this->show_earings = json_decode($staffpayrollid->earning_breakup, true);
        $this->show_deductions = json_decode($staffpayrollid->deduction_breakup, true);

        $this->staff = Staff::find($staffpayrollid->staff_id);

        $this->earning = $this->staff->earnings->toArray();
        $this->deduction = $this->staff->deductions->toArray();

        $this->basic_salary = $this->staff->basic_salary;
        $this->total_earning = $this->staff->earnings->sum('value');
        $this->total_deducton = $this->staff->deductions->sum('value');

        $this->gross_salary = $this->total_earning + $this->basic_salary - $this->total_deducton;
        $this->tax = $staffpayrollid->tax;
        $this->net_salary = $this->gross_salary - $this->tax;

        $month_string = Carbon::parse($staffpayrollid->month_string)->format('F Y');

        $this->no_of_days_present = $this->staff->staffattendancelist
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('present', true)
            ->count();
        $this->no_of_days_absent = $this->staff->staffattendancelist
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('absent', true)
            ->count();
        $this->lop = 0;
        $this->halfdays = $this->staff->staffattendancelist
            ->where('month_string', $month_string)
            ->where('is_holiday', false)
            ->where('halfday', true)
            ->count();
    }

    public function addearning()
    {
        $this->earning[] = [
            'name' => '',
            'value' => '',
        ];

    }

    public function removeearning($earningskey)
    {
        unset($this->earning[$earningskey]);
    }

    public function saveearning()
    {
        try {
            DB::beginTransaction();
            $this->validate([
                'earning.*.name' => 'required|string',
                'earning.*.value' => 'required|numeric',
            ], [
                'earning.*.name.required' => 'Required',
                'earning.*.value.required' => 'Required',
                'earning.*.value.numeric' => 'Field Must be Number',
            ]);

            $user = auth()->user();

            if ($this->staff->earnings->count() != 0) {
                $this->staff->earnings->each->delete();
            }

            foreach ($this->earning as $eachearning) {
                Payrollearndeduct::create([
                    'staff_id' => $this->staff->id,
                    'type' => 1,
                    'name' => $eachearning['name'],
                    'value' => $eachearning['value'],
                    'user_id' => $user->id,
                    'created_by' => $user->name,
                ]);
            }
            DB::commit();

            $this->toast ? $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Earnings Saved']) : '';

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate_staffearings', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate_staffearings', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate_staffearings', 'three', $e);
        }
    }

    public function adddeduction()
    {
        $this->deduction[] = [
            'name' => '',
            'value' => '',
        ];

    }

    public function removededuction($deductionskey)
    {
        unset($this->deduction[$deductionskey]);
    }

    public function savededuction()
    {
        try {
            DB::beginTransaction();
            $this->validate([
                'deduction.*.name' => 'required|string',
                'deduction.*.value' => 'required|numeric',
            ], [
                'deduction.*.name.required' => 'Required',
                'deduction.*.value.required' => 'Required',
                'deduction.*.value.numeric' => 'Field Must be Number',
            ]);

            $user = auth()->user();

            if ($this->staff->deductions->count() != 0) {
                $this->staff->deductions->each->delete();
            }

            foreach ($this->deduction as $eachdeduction) {
                Payrollearndeduct::create([
                    'staff_id' => $this->staff->id,
                    'type' => 0,
                    'name' => $eachdeduction['name'],
                    'value' => $eachdeduction['value'],
                    'user_id' => $user->id,
                    'created_by' => $user->name,
                ]);
            }
            DB::commit();
            $this->toast ? $this->dispatchBrowserEvent('successtoast', ['message' => 'Staff Deduction Saved']) : '';

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function netsalary()
    {
        $this->total_earning = collect(array_diff(array_column($this->earning, 'value'), ['']))->sum();
        $this->total_deducton = collect(array_diff(array_column($this->deduction, 'value'), ['']))->sum();
        $this->gross_salary = $this->total_earning + $this->basic_salary - $this->total_deducton;
        $this->net_salary = $this->gross_salary - ($this->tax ? $this->tax : 0);
    }

    public function generatepayroll()
    {
        try {
            //To save all the earnings and deduction 1st

            $this->toast = false;
            $this->savededuction();
            $this->saveearning();
            $this->netsalary();

            DB::beginTransaction();
            $earning = json_encode($this->earning);
            $deduction = json_encode($this->deduction);
            $staffpayroll = Payrolleachmonth::find($this->staffpayroll->id)
                ->update([
                    'earning' => $this->total_earning,
                    'deduction' => $this->total_deducton,
                    'gross_salary' => $this->gross_salary,
                    'tax' => ($this->tax ? $this->tax : 0),
                    'net_salary' => $this->net_salary,
                    'earning_breakup' => $earning,
                    'deduction_breakup' => $deduction,
                    'is_generated' => true,
                    'no_of_days_present' => $this->no_of_days_present,
                    'no_of_days_absent' => $this->no_of_days_absent,
                    'lop' => $this->lop,
                    'halfdays' => $this->halfdays,
                ]);
            DB::commit();
            $this->show_earings = json_decode($earning, true);
            $this->show_deductions = json_decode($deduction, true);

            $this->staffpayroll_generated = true;

            $this->dispatchBrowserEvent('successtoast', ['message' => 'Payroll Generated']);
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function render()
    {
        return view('livewire.admin.staff.payroll.payrollgeneratelivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_payroll_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
