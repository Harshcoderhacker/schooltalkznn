<?php

namespace App\Repository\Api\Admin\Interfacelayer\Attendance;

interface IAdminattendanceApiRepository
{
    public function adminstudentattendancelist();

    public function adminstaffattendancelist();

    public function adminleaveapplicationlist();

    public function adminleavestatusupdate();

}
