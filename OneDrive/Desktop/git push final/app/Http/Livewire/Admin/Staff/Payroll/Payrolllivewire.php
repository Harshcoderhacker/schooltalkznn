<?php

namespace App\Http\Livewire\Admin\Staff\Payroll;

use App\Models\Admin\Staff\Payroll\Payroll;
use App\Models\Admin\Staff\Payroll\Payrolleachmonth;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;

class Payrolllivewire extends Component
{
    use WithPagination;

    public $searchTerm = null;

    public $sortColumnName = 'created_at';

    public $sortDirection = 'desc';

    public $paginationlength = 5;

    public $payrollid, $month_string, $tot_no_of_working_days, $remarks, $tot_no_of_days;

    public $isModalFormOpen = false;

    public $payrollshowdata;

    public $isshowmodalopen = false;

    public function payrollshowmodal()
    {
        $this->isshowmodalopen = true;
    }
    public function payrollclosemodal()
    {
        $this->isshowmodalopen = false;
        $this->payrollshowdata = [];
    }

    public function isModalFormOpen()
    {
        $this->isModalFormOpen = true;
    }

    public function closeFormModalPopover()
    {
        $this->isModalFormOpen = false;
    }

    protected function rules()
    {
        return [
            'month_string' => 'required|unique:payrolls,month_string,' . $this->payrollid,
            'tot_no_of_working_days' => 'required|numeric|min:0|max: ' . $this->tot_no_of_days,
            'remarks' => 'nullable',
        ];
    }

    protected function messages()
    {
        return [
            'month_string.required' => 'Field is required',
            'month_string.unique' => 'Field ALready Created',
            'tot_no_of_working_days.required' => 'Field is required',
            'tot_no_of_working_days.numeric' => 'Field must be numeric',
            'tot_no_of_working_days.max' => 'Must Not be Greater Than ' . $this->tot_no_of_days,
        ];
    }

    public function show(Payroll $payroll)
    {
        $this->payrollshowdata = $payroll;
        $this->payrollshowmodal();
    }

    public function createorupdatepayroll()
    {
        $this->tot_no_of_days = Carbon::parse($this->month_string)->daysInMonth;
        $validate = $this->validate();
        try {
            DB::beginTransaction();

            $validate['tot_no_of_days'] = $this->tot_no_of_days;
            $validate['month_date'] = Carbon::create($validate['month_string'], 1);
            $validate['month_string_search'] = Carbon::parse($validate['month_string'])->format('M-Y');

            $payroll = Payroll::updateOrCreate(['id' => $this->payrollid], $validate);

            if (!$this->payrollid) {
                $staff = Staff::where('is_accountactive', true)->get();

                foreach ($staff as $key => $value) {
                    $staff_details[] = [
                        'staff_roll_id' => $value->staff_roll_id,
                        'name' => $value->name,
                        'phone' => $value->phone,
                        'email' => $value->email,
                        'role' => $value->role,
                        'department' => $value->staffdepartment->name,
                        'desgination' => $value->staffdesignation->name,
                        'doj' => $value->doj,
                        'basic_salary' => $value->basic_salary,
                        'account_name' => $value->staffotherdetail?->account_name,
                        'bank_name' => $value->staffotherdetail?->bank_name,
                        'account_no' => $value->staffotherdetail?->account_no,
                        'ifsc_code' => $value->staffotherdetail?->ifsc_code,
                        'bank_branch' => $value->staffotherdetail?->bank_branch,
                    ];

                    Payrolleachmonth::create([
                        'month_string' => $validate['month_string'],
                        'staff_id' => $value->id,
                        'payroll_id' => $payroll->id,
                        'staff_roll_id' => $value->staff_roll_id,
                        'name' => $value->name,
                        'phone' => $value->phone,
                        'staff_details' => $value->phone,
                        'basic_salary' => $value->basic_salary,
                        'staff_details' => json_encode($staff_details),
                    ]);
                    $staff_details = null;
                }
            }

            Helper::trackmessage(auth()->user(),
                'Admin Payroll ' . ($this->payrollid) ? 'Update' : 'Create',
                'admin_web_payroll_' . ($this->payrollid) ? 'update' : 'create',
                session()->getId(),
                'WEB');

            DB::commit();

            if ($this->payrollid) {
                $this->dispatchBrowserEvent('successtoast', ['message' => "Admin Payroll Updated Successfully!"]);
            } else {
                $this->dispatchBrowserEvent('successtoast', ['message' => "Admin Payroll Created Successfully!"]);
            }
            $this->formrest();
            $this->resetPage();
            $this->closeFormModalPopover();

        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'One', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'Two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'Three', $e);
        }
    }

    public function edit(Payroll $payroll)
    {
        $this->payrollid = $payroll->id;
        $this->month_string = $payroll->month_string;
        $this->tot_no_of_working_days = $payroll->tot_no_of_working_days;
        $this->remarks = $payroll->remarks;
        $this->tot_no_of_days = $payroll->tot_no_of_days;
        $this->isModalFormOpen();
    }

    public function formrest()
    {
        $this->payrollid = null;
        $this->month_string = null;
        $this->tot_no_of_working_days = null;
        $this->remarks = null;
        $this->tot_no_of_days = null;
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
        $payroll = Payroll::query()
            ->where('month_string_search', 'like', '%' . $this->searchTerm . '%')
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate($this->paginationlength)->onEachSide(1);

        return view('livewire.admin.staff.payroll.payrolllivewire', compact('payroll'));

    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_smstemplate_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
