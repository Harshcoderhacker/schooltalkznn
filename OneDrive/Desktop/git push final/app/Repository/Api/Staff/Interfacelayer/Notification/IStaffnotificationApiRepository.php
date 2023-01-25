<?php

namespace App\Repository\Api\Staff\Interfacelayer\Notification;

interface IStaffnotificationApiRepository
{
    public function getstaffnotification();

    public function staffmarkasreadnotification();

    public function getstaffnotificationdetails();

    public function getstaffpushnotificationdetails();

}
