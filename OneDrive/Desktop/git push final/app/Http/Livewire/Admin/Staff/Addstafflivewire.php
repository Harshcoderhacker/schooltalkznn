<?php

namespace App\Http\Livewire\Admin\Staff;

use App\Models\Admin\Settings\Academicsetting\Classroutine;
use App\Models\Admin\Settings\Staffsetting\Staffdepartment;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use App\Models\Miscellaneous\Helper;
use App\Models\Staff\Auth\Staff;
use App\Models\Staff\Auth\Staffotherdetail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithFileUploads;
use Spatie\Permission\Models\Role;

class Addstafflivewire extends Component
{

    use WithFileUploads;

    public $staffid, $show = 1;
    public $allrole;
    public $designation, $department;

    public $name, $staff_roll_id, $last_name, $role, $staffdepartment_id, $staffdesignation_id,
        $gender, $email, $phone, $marital_status, $dob, $doj, $emerency_number, $address;

    // File Upload
    public $resume, $degree_certificate, $school_certificate, $document_one, $document_two, $document_three;
    public $existing_resume;

    public $existing_degree_certificate, $existing_school_certificate;
    public $existing_document_one, $existing_document_two, $existing_document_three;

    public $edf_number, $basic_salary, $contract_type_id, $location;

    // Bank Details
    public $account_name, $bank_name, $account_no, $ifsc_code, $bank_branch;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:35',
            'staff_roll_id' => 'required',
            'last_name' => 'required|max:35',
            'role' => 'required|integer',
            'staffdepartment_id' => 'required|numeric',
            'staffdesignation_id' => 'required|numeric',
            'gender' => 'required|numeric',
            'email' => 'required|email|unique:staff,email,' . $this->staffid,
            'phone' => 'required|digits:10|unique:staff,phone,' . $this->staffid,
            'marital_status' => 'required|numeric',
            'dob' => 'required|before:' . Carbon::now()->subYear(15),
            // 'doj' => 'required|date',
            // 'emerency_number' => 'required|digits:10',
            // 'address' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'Name cannot be empty',
        'name.min' => 'Name should have minimum 3 letters',
        'name.max' => 'Name should not exceed 35 letters',
        'staff_roll_id.required' => 'Staff Role ID cannot be empty',
        'last_name.required' => 'Last Name cannot be empty',
        'last_name.max' => 'Last Name should not exceed 35 letters',
        'role.required' => 'Select a Role',
        'staffdepartment_id.required' => 'Select a Department',
        'staffdesignation_id.required' => 'Select a Designation',
        'gender.required' => 'Select the Gender',
        'email.required' => 'The Email cannot be empty',
        'email.email' => 'Not a valid Email',
        'email.unique' => 'Email Address already taken',
        'phone.required' => 'Phone Number needed',
        'phone.digits' => 'Invalid Phone Number',
        'phone.unique' => 'Phone Number already taken',
        'marital_status.required' => 'Select Marital Status',
        'dob.required' => 'Select a Date',
        'dob.before' => 'Invalid Date',
        // 'doj.required' => 'Select a Date',
        // 'emerency_number.required' => 'Phone Number needed',
        // 'emerency_number.digits' => 'Invalid Phone Number',
        // 'address.required' => 'Enter the Staff address',
    ];

    public function mount(Staff $staff, $show)
    {
        if ($staff) {
            $this->staffid = $staff->id;
            $this->name = $staff->name;
            $this->staff_roll_id = $staff->staff_roll_id;
            $this->last_name = $staff->last_name;
            $this->role = $staff->role;
            $this->staffdepartment_id = $staff->staffdepartment_id;
            $this->staffdesignation_id = $staff->staffdesignation_id;
            $this->gender = $staff->gender;
            $this->email = $staff->email;
            $this->phone = $staff->phone;
            $this->marital_status = $staff->marital_status;
            $this->dob = $staff->dob;
            // $this->doj = $staff->doj;
            // $this->emerency_number = $staff->emerency_number;
            // $this->address = $staff->address;
            // $this->edf_number = $staff->edf_number;
            // $this->basic_salary = $staff->basic_salary;
            // $this->contract_type_id = $staff->contract_type_id;
            // $this->location = $staff->location;

            // $this->account_name = $staff->staffotherdetail?->account_name;
            // $this->bank_name = $staff->staffotherdetail?->bank_name;
            // $this->account_no = $staff->staffotherdetail?->account_no;
            // $this->ifsc_code = $staff->staffotherdetail?->ifsc_code;
            // $this->bank_branch = $staff->staffotherdetail?->bank_branch;

            // $this->existing_resume = $staff->staffotherdetail?->resume;

            // $this->existing_degree_certificate = $staff->staffotherdetail?->degree_certificate;
            // $this->existing_school_certificate = $staff->staffotherdetail?->school_certificate;
            // $this->existing_document_one = $staff->staffotherdetail?->document_one;
            // $this->existing_document_two = $staff->staffotherdetail?->document_two;
            // $this->existing_document_three = $staff->staffotherdetail?->document_three;
        }

        $this->show = $show ? $show : 1;

        $department = Staffdepartment::all();
        $this->department = $department;

        $designation = Staffdesignation::all();
        $this->designation = $designation;

        $allrole = Role::all();
        $this->allrole = $allrole;
    }

    public function staffinfo()
    {
        $this->basicvalidate = $this->validate();
        $this->staffdocumentupload();
        // $this->show = 2;
    }

    public function payroll()
    {
        // $this->validate([
        //     'edf_number' => 'required',
        //     'contract_type_id' => 'required|numeric',
        //     'basic_salary' => 'required',
        //     'location' => 'required',
        // ], [
        //     'edf_number.required' => 'Enter EDF Number',
        //     'contract_type_id.required' => 'Select Staff Contract Type',
        //     'basic_salary' => 'Enter Basic Salary',
        //     'location' => 'Enter the Location',
        // ]);

        $this->show = 3;
    }

    public function bankinfo()
    {
        // $this->validate([
        //     'account_name' => 'required',
        //     'bank_name' => 'required',
        //     'account_no' => 'required',
        //     'ifsc_code' => 'required',
        //     'bank_branch' => 'required',
        // ], [
        //     'account_name.required' => 'Enter Staff Bank Account Name ',
        //     'bank_name.required' => 'Enter the Bank Name',
        //     'account_no.required' => 'Enter Account Number',
        //     'ifsc_code.required' => 'Enter IFSC Code',
        //     'bank_branch.required' => 'Enter the Bank Branch',
        // ]);

        $this->show = 4;
    }

    public function staffdocumentupload()
    {
        // $this->validate([
        //     'resume' => "nullable|mimes:pdf,docx,doc|max:10240",
        //     'degree_certificate' => "nullable|mimes:pdf,docx,doc|max:10240",
        //     'school_certificate' => "nullable|mimes:pdf,docx,doc|max:10240",
        //     'document_one' => "nullable|mimes:pdf,docx,doc|max:10240",
        //     'document_two' => "nullable|mimes:pdf,docx,doc|max:10240",
        //     'document_three' => "nullable|mimes:pdf,docx,doc|max:10240",
        // ]);

        try {
            DB::beginTransaction();

            $this->createoreditstaffbasicinfo();
            // $this->createoreditpayroll();
            // $this->createoreditbankinfo();
            // $this->createoreditstaffdocument();

            Helper::trackmessage(auth()->user(), 'Admin Staff Create/Edit', 'admin_web_staff_create/edit', session()->getId(), 'WEB');
            DB::commit();

            redirect()->route('adminstaff');
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    protected function createoreditstaffbasicinfo()
    {


        if ($this->staffid) {
            $staff = Staff::find($this->staffid)->update($this->basicvalidate);
        } else {
            //     $this->basicvalidate['password'] = Carbon::parse($this->dob)->format('d-m-Y') . substr($this->basicvalidate['phone'], -4);
            $this->basicvalidate['password'] = $this->basicvalidate['phone'];

            $staff = Staff::create($this->basicvalidate);
            $staff->classroutine()
                ->sync(Classroutine::where('active', true)
                    ->pluck('id'));
            $staffotherdetail = new Staffotherdetail();
            $staffotherdetail->staff_id = $staff->id;
            $staff->staffotherdetail()->save($staffotherdetail);
            $this->staffid = $staff->id;
        }
    }

    protected function createoreditpayroll()
    {
        Staff::find($this->staffid)->update([
            'edf_number' => $this->edf_number,
            'basic_salary' => $this->basic_salary,
            'contract_type_id' => $this->contract_type_id,
            'location' => $this->location,
        ]);
    }

    protected function createoreditbankinfo()
    {
        $staffotherdetail['account_name'] = $this->account_name;
        $staffotherdetail['bank_name'] = $this->bank_name;
        $staffotherdetail['account_no'] = $this->account_no;
        $staffotherdetail['ifsc_code'] = $this->ifsc_code;
        $staffotherdetail['bank_branch'] = $this->bank_branch;
        Staff::find($this->staffid)->staffotherdetail()->update($staffotherdetail);
    }

    protected function createoreditstaffdocument()
    {
        $staffotherdetail = [];

        $file = $this->resume;

        if ($file) {
            ($this->existing_resume) ? Storage::delete('public/' . $this->existing_resume) : '';
            $fileName = 'Staff-Resume' . time() . '.' . $file->getClientOriginalExtension();
            $staffotherdetail['resume'] = $file->storeAs('Staff/Doucment/', $fileName);
        }

        $degreefile = $this->degree_certificate;
        if ($degreefile) {
            ($this->existing_degree_certificate) ? Storage::delete('public/' . $this->existing_degree_certificate) : '';
            $degreefilename = 'Staff-Degree Certificate' . time() . '.' . $degreefile->getClientOriginalExtension();
            $staffotherdetail['degree_certificate'] = $degreefile->storeAs('Staff/Doucment/', $degreefilename);
        }

        $schoolfile = $this->school_certificate;
        if ($schoolfile) {
            ($this->existing_school_certificate) ? Storage::delete('public/' . $this->existing_school_certificate) : '';
            $schoolfileName = 'Staff-school Certificate' . time() . '.' . $schoolfile->getClientOriginalExtension();
            $staffotherdetail['school_certificate'] = $schoolfile->storeAs('Staff/Doucment/', $schoolfileName);
        }

        $document_onefile = $this->document_one;
        if ($document_onefile) {
            ($this->existing_document_one) ? Storage::delete('public/' . $this->existing_document_one) : '';
            $fileName = 'Staff-document_one Certificate' . time() . '.' . $document_onefile->getClientOriginalExtension();
            $staffotherdetail['document_one'] = $document_onefile->storeAs('Staff/Doucment/', $fileName);
        }

        $document_twofile = $this->document_two;
        if ($document_twofile) {
            ($this->existing_document_two) ? Storage::delete('public/' . $this->existing_document_two) : '';
            $fileName = 'Staff-document_two Certificate' . time() . '.' . $document_twofile->getClientOriginalExtension();
            $staffotherdetail['document_two'] = $document_twofile->storeAs('Staff/Doucment/', $fileName);
        }

        $document_threefile = $this->document_three;
        if ($document_threefile) {
            ($this->existing_document_three) ? Storage::delete('public/' . $this->existing_document_three) : '';
            $fileName = 'Staff-document_three Certificate' . time() . '.' . $document_threefile->getClientOriginalExtension();
            $staffotherdetail['document_three'] = $document_threefile->storeAs('Staff/Doucment/', $fileName);
        }

        if (sizeof($staffotherdetail) > 0) {
            DB::beginTransaction();
            Staff::find($this->staffid)->staffotherdetail()->update($staffotherdetail);
            Helper::trackmessage(auth()->user(), 'Admin Staff Doucument Create/Edit', 'admin_web_staff_doucument_create/edit', session()->getId(), 'WEB');
            DB::commit();
        }
    }

    public function back($step)
    {
        $this->show = $step;
    }

    public function current($currentstep)
    {
        $this->show = $currentstep;
    }

    public function render()
    {
        return view('livewire.admin.staff.addstafflivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_staff_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
