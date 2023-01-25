<?php

namespace App\Repository\Api\Staff\Interfacelayer\Classinfo;

interface IStaffclassdetailApiRepository
{
    public function classteacherclassmaster();

    public function staffclassmasterdetails();

    public function staffclassmasterattendancedetails();

    public function classteacherclassroutineinfo();

    public function staffgetprogressbyclassectionuuid();
}
