<?php

namespace App\Imports\Student;

use App\Models\Admin\Settings\Academicsetting\ClassmasterSection;
use App\Models\Admin\Student\Student;
use App\Models\Parent\Auth\Aparent;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StudentImport implements ToModel, WithHeadingRow, WithValidation
{
    public function __construct($academicyear, $classmasterid, $sectionid)
    {
        $this->academicyear = $academicyear;
        $this->classmasterid = $classmasterid;
        $this->sectionid = $sectionid;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        $aparent = Aparent::where('phone', $row['phone_no'])->first();
        if ($aparent) {
            $aparent->update([
                'mother_name' => $row['mother_name'],
                // 'mother_occupation' => $row['mother_occupation'],
                // 'mother_phoneno' => $row['mother_phoneno'],
                'father_name' => $row['father_name'],
                // 'father_occupation' => $row['father_occupation'],
                // 'father_phoneno' => $row['father_phoneno'],
                // 'father_office_address' => $row['father_office_address'],
            ]);
            $aparent->save();
            $aparentid = $aparent->id;
        } else {
            $aparentid = Aparent::create([
                'phone' => $row['phone_no'],
                'email' => $row['email'],
                'name' => $row['name'],
                // 'password' => Carbon::parse($row['dob'])->format('d-m-Y') . substr($row['phone_no'], -4),
                // 'current_password' => Carbon::parse($row['dob'])->format('d-m-Y') . substr($row['phone_no'], -4),
                'password' => $row['phone_no'],
                'current_password' => $row['phone_no'],
                'mother_name' => $row['mother_name'],
                // 'mother_occupation' => $row['mother_occupation'],
                // 'mother_phoneno' => $row['mother_phoneno'],
                'father_name' => $row['father_name'],
                // 'father_occupation' => $row['father_occupation'],
                // 'father_phoneno' => $row['father_phoneno'],
                // 'father_office_address' => $row['father_office_address'],
            ])->id;
        }
        return new Student([
            'name' => $row['name'],
            'academicyear_id' => $this->academicyear,
            'classmaster_id' => $this->classmasterid,
            'section_id' => $this->sectionid,
            // 'addmission_number' => $row['addmission_number'],
            'roll_no' => $row['roll_no'],
            'gender' => $row['gender'],
            'last_name' => $row['last_name'],
            'dob' => Carbon::parse($row['dob']),
            'phone_no' => $row['phone_no'],
            'email' => $row['email'],
            // 'blood_group' => $row['blood_group'],
            // 'emis_number' => $row['emis_number'],
            // 'address' => $row['address'],
            'aparent_id' => $aparentid,
            // 'route_no' => $row['route_no'],
            // 'bus_no' => $row['bus_no'],
            // 'fee_amount' => $row['fee_amount'],
            // 'route_address' => $row['route_address'],
            // 'adhaar_no' => $row['adhaar_no'],
            'classmaster_section_id' => ClassmasterSection::where('classmaster_id', $this->classmasterid)
                ->where('section_id', $this->sectionid)
                ->first()->id,
            'password' => Carbon::parse($row['dob'])->format('d-m-Y') . substr($row['phone_no'], -4),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required|min:1',
            '*.addmission_number' => 'required|unique:students,addmission_number',
            '*.roll_no' => 'required',
            '*.gender' => 'required|integer',
            '*.last_name' => 'required',
            '*.dob' => 'required|date|before:' . Carbon::now()->subYear(),
            '*.phone_no' => 'required|numeric|digits:10',
            '*.email' => 'required|email',
            // '*.blood_group' => 'nullable|integer',
            // '*.religion' => 'nullable|integer',
            // '*.emis_number' => 'nullable',
            // '*.address' => 'required',
            // '*.primary_name' => 'required',
            // '*.route_no' => 'nullable',
            // '*.bus_no' => 'nullable',
            // '*.fee_amount' => 'nullable',
            // '*.route_address' => 'nullable',
            // '*.adhaar_no' => 'nullable',

            '*.mother_name' => 'required|min:3|max:35',
            // '*.mother_occupation' => 'nullable',
            // '*.mother_phoneno' => 'nullable|digits:10',
            '*.father_name' => 'required|min:3|max:35',
            // '*.father_occupation' => 'nullable',
            // '*.father_phoneno' => 'nullable|digits:10',
            // '*.father_office_address' => 'nullable',
        ];
    }
}
