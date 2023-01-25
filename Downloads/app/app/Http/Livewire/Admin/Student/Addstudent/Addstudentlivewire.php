<?php

namespace App\Http\Livewire\Admin\Student\Addstudent;

use App\Models\Admin\Settings\Academicsetting\Classmaster;
use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Settings\Academicsetting\Section;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use App\Models\Admin\Student\Student;
use App\Models\Miscellaneous\Helper;
use App\Models\Parent\Auth\Aparent;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Image;
use Livewire\Component;
use Livewire\WithFileUploads;
use Storage;

class Addstudentlivewire extends Component
{
    use WithFileUploads;

    public $searchaparentlist, $aparent_selected;

    public $studentid, $show = 1;

    public $academicyear_id;
    public $classmasterid;
    public $section_id;

    public $name, $addmission_number;
    public $roll_no, $gender, $last_name, $dob, $phone_no, $email, $blood_group, $religion, $emis_number, $address;

    public $parentid, $primary_number, $primary_email, $primary_name;

    public $phone, $mother_name, $mother_occupation, $mother_phoneno;

    public $father_name, $father_occupation, $father_phoneno, $father_office_address;

    public $route_no, $adhaar_no;
    public $bus_no, $fee_amount, $route_address;

    public $allacademicyear;

    public $existingphoto, $photo;

    protected function rules()
    {
        return [
            'name' => 'required|min:3|max:35',
            'academicyear_id' => 'required|integer',
            'classmasterid' => 'required|integer',
            'section_id' => 'required|integer',
            // 'addmission_number' => 'required',
            'roll_no' => 'required',
            'gender' => 'required|integer',
            'last_name' => 'required|max:35',
            'dob' => 'required|before:' . Carbon::now()->subYear(),
            'phone_no' => 'required|min:7|max:15',
            'email' => 'required|email',
            // 'blood_group' => 'nullable|integer',
            // 'religion' => 'required|integer',
            // 'emis_number' => 'nullable|digits:11',
            // 'address' => 'required',
        ];
    }

    protected $messages = [
        'name.required' => 'Name cannot be empty',
        'name.min' => 'Name should have minimum 3 letters',
        'name.max' => 'Name should not exceed 35 letters',
        'academicyear_id.integer' => 'Select an Academic Year',
        'classmasterid.required' => 'Select a Class',
        'section_id.required' => 'Select a Section',
        // 'addmission_number.required' => 'Enter Admission Number of the Student',
        'roll_no.required' => 'Enter the Roll Number of the Student',
        'gender.required' => 'Select the Gender',
        'dob.required' => 'Select a Date',
        'dob.before' => 'Invalid Date',
        'phone_no.required' => 'Phone Number needed',
        'phone_no.digits' => 'Invalid Phone Number',
        'email.required' => 'The Email cannot be empty',
        'email.email' => 'Not a valid Email',
        // 'religion.required' => 'Select a Religion',
        // 'emis_number.digits' => 'EMIS Number must be 11 digits',
        // 'address.required' => 'Enter the Student address',
    ];

    public function mount(Student $student, $show)
    {
        $this->studentid = $student->id;
        $this->name = $student->name;
        $this->academicyear_id = $student->academicyear_id;
        $this->classmasterid = $student->classmaster_id;
        $this->section_id = $student->section_id;
        $this->addmission_number = $student->addmission_number;
        $this->roll_no = $student->roll_no;
        $this->gender = $student->gender;
        $this->last_name = $student->last_name;
        $this->dob = $student->dob;
        $this->phone_no = $student->phone_no;
        $this->email = $student->email;
        $this->blood_group = $student->blood_group;
        $this->religion = $student->religion;
        $this->emis_number = $student->emis_number;
        $this->address = $student->address;

        $aparent = Aparent::find($student->aparent_id);

        if ($aparent != null) {
            $this->parentid = $aparent->id;
            $this->primary_number = $aparent->phone;
            $this->primary_email = $aparent->email;
            $this->primary_name = $aparent->name;
            $this->mother_name = $aparent->mother_name;
            $this->mother_occupation = $aparent->mother_occupation;
            $this->mother_phoneno = $aparent->mother_phoneno;
            $this->father_name = $aparent->father_name;
            $this->father_occupation = $aparent->father_occupation;
            $this->father_phoneno = $aparent->father_phoneno;
            $this->father_office_address = $aparent->father_office_address;
        }

        $this->bus_no = $student->bus_no;
        $this->fee_amount = $student->fee_amount;
        $this->route_address = $student->route_address;
        $this->route_no = $student->route_no;
        $this->adhaar_no = $student->adhaar_no;

        $this->existingphoto = $student->photo;

        $allacademicyear = Academicyear::all();
        $this->allacademicyear = $allacademicyear;

        $this->academicyear_id = App::make('generalsetting')->academicyear_id;

        $allclassmaster = Classmaster::where('active', true)->get();
        $this->allclassmaster = $allclassmaster;

        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }

        $this->show = $show;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function updatedClassmasterid()
    {
        $this->section_id = '';
        if ($this->classmasterid) {
            $this->section = Classmaster::find($this->classmasterid)->section;
        } else {
            $this->section = [];
        }
    }

    public function createorupdate()
    {
        $this->validated = $this->validate();

        $aparent = Aparent::where('phone', $this->validated['phone_no'])->first();

        if ($aparent) {

            $this->parentid = $aparent->id;
            $this->primary_number = $aparent->phone;
            $this->primary_email = $aparent->email;
            $this->primary_name = $aparent->name;
            $this->mother_name = $aparent->mother_name;
            $this->mother_occupation = $aparent->mother_occupation;
            $this->mother_phoneno = $aparent->mother_phoneno;
            $this->father_name = $aparent->father_name;
            $this->father_occupation = $aparent->father_occupation;
            $this->father_phoneno = $aparent->father_phoneno;
            $this->father_office_address = $aparent->father_office_address;
        } else {

            // $this->name = $this->validated['name'];
            $this->primary_number = $this->validated['phone_no'];
            $this->primary_email = $this->validated['email'];
        }

        $this->show = 2;
    }

    public function parents()
    {
        $this->validate([
            // 'primary_name' => 'required|min:3|max:35',
            'mother_name' => 'required|min:3|max:35',
            // 'mother_occupation' => 'nullable',
            // 'mother_phoneno' => 'nullable|digits:10',
            'father_name' => 'required|min:3|max:35',
            // 'father_occupation' => 'nullable',
            // 'father_phoneno' => 'nullable|digits:10',
            // 'father_office_address' => 'nullable',
        ], [
            // 'primary_name.required' => 'Primary Name should not be empty',
            // 'primary_name.min' => 'Primary Name should have minimum 3 letters',
            // 'primary_name.max' => 'Primary Name should not exceed 35 letters',
            'mother_name.required' => "Mother's Name should not be empty",
            'mother_name.min' => "Mothers Name should have minimum 3 letters",
            'mother_name.max' => "Mothers Name should not exceed 35 letters",
            // 'mother_phoneno.digits' => 'Invalid Phone Number',
            'father_name.required' => "Father's Name should not be empty",
            'father_name.min' => "Father's Name should have minimum 3 letters",
            'father_name.max' => "Father's Name should not exceed 35 letters",
            // 'father_phoneno.digits' => 'Invalid Phone Number',
        ]);

        $this->show = 4;
    }

    public function transport()
    {
        // $this->validate([
        // 'route_no' => 'nullable',
        // 'bus_no' => 'nullable',
        // 'fee_amount' => 'nullable',
        // 'route_address' => 'nullable',
        // ]);

        $this->show = 4;
    }

    public function documents()
    {
        $this->validate([
            // 'adhaar_no' => 'nullable|digits:12',
            'photo' => 'nullable|image|max:1024',
        ], [
            // 'adhaar_no.digits' => 'Aadhar Number must a 12 digit Number',
            'photo.image' => 'Photo must be an image format',
            'photo.max' => 'Photo must be in a size of 1mb or less than 1mb',
        ]);

        try {
            DB::beginTransaction();

            $this->createoreditstudent();
            $this->parentdetail();
            // $this->transportdetail();
            $this->documentdetail();

            Helper::trackmessage(auth()->user(), 'Admin Student Create/Edit', 'admin_web_student_create/edit', session()->getId(), 'WEB');
            DB::commit();

            redirect()->route('adminstudent');
        } catch (Exception $e) {
            $this->exceptionerror('createorupdate', 'one', $e);
        } catch (QueryException $e) {
            $this->exceptionerror('createorupdate', 'two', $e);
        } catch (PDOException $e) {
            $this->exceptionerror('createorupdate', 'three', $e);
        }
    }

    public function createoreditstudent()
    {

        if ($this->studentid) {
            $student = Student::find($this->studentid);

            $student->phone_no = $this->phone_no;
            $aparent = [];
            //            {if ($student->isDirty() || 1) {
            {
                if (!empty($student)) {
                    $aparent = Aparent::where('phone', $this->validated['phone_no'])->first();
                }

                if ($aparent != null) {
                    $aparentid = $aparent->id;
                } else {
                    // dd($this->validated());
                    $aparentid = Aparent::create([
                        // 'name' => $this->primary_name,
                        'name' => $this->name,
                        'mother_name' => $this->mother_name,
                        // 'mother_occupation' => $this->mother_occupation,
                        // 'mother_phoneno' => $this->mother_phoneno,
                        'father_name' => $this->father_name,
                        // 'father_occupation' => $this->father_occupation,
                        // 'father_phoneno' => $this->father_phoneno,
                        // 'father_office_address' => $this->father_office_address,

                        'phone' => $this->validated['phone_no'],
                        'email' => $this->validated['email'],

                        'password' => Carbon::parse($this->validated['dob'])->format('d-m-Y') . substr($this->validated['phone_no'], -4),
                        'current_password' => Carbon::parse($this->validated['dob'])->format('d-m-Y') . substr($this->validated['phone_no'], -4),
                    ])->id;
                }
                $this->validated['aparent_id'] = $aparentid;
            }

            $this->validated['classmaster_section_id'] = ClassmasterSection::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->section_id)
                ->first()->id;
            $student->update($this->validated);
        } else {

            $aparent = Aparent::where('phone', $this->validated['phone_no'])->first();

            if ($aparent != null) {
                $aparentid = $aparent->id;
            } else {

                // dd('herr create');
                $aparentid = Aparent::create([
                    'name' => $this->name,
                    'mother_name' => $this->mother_name,
                    // 'mother_occupation' => $this->mother_occupation,
                    // 'mother_phoneno' => $this->mother_phoneno,
                    'father_name' => $this->father_name,
                    // 'father_occupation' => $this->father_occupation,
                    // 'father_phoneno' => $this->father_phoneno,
                    // 'father_office_address' => $this->father_office_address,

                    'phone' => $this->validated['phone_no'],
                    'email' => $this->validated['email'],
                    'password' => $this->validated['phone_no'],
                    // 'current_password' => $this->validated['phone_no'],

                    'password' => Carbon::parse($this->validated['dob'])->format('d-m-Y') . substr($this->validated['phone_no'], -4),
                    'current_password' => Carbon::parse($this->validated['dob'])->format('d-m-Y') . substr($this->validated['phone_no'], -4),
                ])->id;
            }

            $this->validated['aparent_id'] = $aparentid;
            $this->validated['classmaster_id'] = $this->classmasterid;
            $this->validated['classmaster_section_id'] = ClassmasterSection::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->section_id)
                ->first()->id;

            $this->validated['password'] = Carbon::parse($this->validated['dob'])->format('d-m-Y') . substr($this->validated['phone_no'], -4);

            $this->studentid = Student::create($this->validated)->id;
            $this->parentid = $aparentid;
        }
    }

    public function parentdetail()
    {
        Aparent::find($this->parentid)->update([
            'name' => $this->name,
            'mother_name' => $this->mother_name,
            // 'mother_occupation' => $this->mother_occupation,
            // 'mother_phoneno' => $this->mother_phoneno,
            'father_name' => $this->father_name,
            // 'father_occupation' => $this->father_occupation,
            // 'father_phoneno' => $this->father_phoneno,
            // 'father_office_address' => $this->father_office_address,
        ]);
    }

    public function transportdetail()
    {
        // Student::find($this->studentid)->update([
        //     'route_no' => $this->route_no,
        //     'bus_no' => $this->bus_no,
        //     'fee_amount' => $this->fee_amount,
        //     'route_address' => $this->route_address,
        // ]);
    }

    public function documentdetail()
    {
        if ($this->photo) {
            ($this->existingphoto) ? Storage::delete('public/' . $this->existingphoto) : '';
            $saveimage = Image::make($this->photo);
            $saveimage->resize(150, 150);
            $saveimage->encode('jpg', 90);
            $saveimage->stream();
            $this->existingphoto = $path = 'image/student/' . time() . '.jpg';
            Storage::disk('public')->put($path, $saveimage, 'public');
        }
        Student::find($this->studentid)->update([
            'adhaar_no' => $this->adhaar_no,
            'photo' => $this->existingphoto,
        ]);
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
        return view('livewire.admin.student.addstudent.addstudentlivewire');
    }

    protected function exceptionerror($msg, $type, $e)
    {
        DB::rollback();
        Log::error("SessionID: " . session()->getId() . ' Exception ' . $type . ': admin_web_student_' . $msg . '  Error: ' . $e->getMessage());
        $this->dispatchBrowserEvent('errortoast', ['message' => $e->getMessage()]);
    }
}
