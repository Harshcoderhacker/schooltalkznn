<?php

namespace App\Repository\Api\Parent\Interfacelayer\Attendance;

interface IParentattendanceApiRepository
{
    public function parentattendancemonthlist();

    public function parentmyattendance();

    public function parentapplyleave();

    public function parentdownloadleavereport();
}
