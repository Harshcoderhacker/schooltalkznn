<?php

namespace App\Repository\Api\Staff\Interfacelayer\Classattendance;

interface IStaffclassattendanceApiRepository
{
    public function getclassattendancelist();

    public function getclassattendancestudentlist();

    public function markstudentattendance();

    public function getstudentattendancedetail();
}
