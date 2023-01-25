<?php

namespace App\Repository\Api\Staff\Interfacelayer\Attendance;

interface IStaffattendanceApiRepository
{
    public function staffstudentattendancelist();

    public function staffmyattendance();

    public function staffattendancemonthlist();

    public function staffapplyleave();

    public function staffleavetypelist();

    public function staffdownloadleavereport();

    public function staffstudentleaverequestlist();

}
