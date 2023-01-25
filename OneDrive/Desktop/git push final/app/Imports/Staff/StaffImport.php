<?php

namespace App\Imports\Staff;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Staff\Auth\Staff;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class StaffImport implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        return new Staff([
            'staff_roll_id'   =>  $row['staff_id'],
            'name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'role'   =>  $row['role'],
            'staffdepartment_id'  =>  $row['department'],
            'staffdesignation_id' =>  $row['designation'],
            'gender' => $row['gender'],
            'email' => $row['email'],
            'phone' => $row['phone_no'],
            'marital_status' => $row['marital_status'],
            'dob' => Carbon::parse($row['dob']),
            'password' => Carbon::parse($row['dob'])->format('d-m-Y') . substr($row['phone_no'], -4),
        ]);
    }

    public function rules(): array
    {
        return [
            '*.staff_id'   =>  'required',
            '*.first_name' => 'required',
            '*.last_name' => 'required',
            '*.role' => 'required',
            '*.department'  =>  'required',
            '*.designation' =>  'required',
            '*.gender'  =>  'required|integer',
            '*.email' => 'required|email',
            '*.phone_no'   =>  'required|numeric|digits:10',
            '*.marital_status'  =>  'required',
            '*.dob' =>  'required|date|before:' . Carbon::now()->subYear(),
        ];
    }
}
