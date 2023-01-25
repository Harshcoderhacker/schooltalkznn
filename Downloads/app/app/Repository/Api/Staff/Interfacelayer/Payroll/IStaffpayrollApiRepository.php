<?php

namespace App\Repository\Api\Staff\Interfacelayer\Payroll;

interface IStaffpayrollApiRepository
{
    public function getstaffpayrolllist();

    public function staffpayrolldownloadbyuuid();
}
