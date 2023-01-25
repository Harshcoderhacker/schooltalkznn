<?php

namespace App\Repository\Api\Admin\Interfacelayer\Payroll;

interface IAdminpayrollApiRepository
{
    public function adminstaffpayrollbyuuid();

    public function adminstaffpayrolldownloadbyuuid($uuid);

    public function adminstaffpayrollsendmailbyuuid($uuid);

}
