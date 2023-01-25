<?php

namespace App\Repository\Api\Admin\Interfacelayer\Notification;

interface IAdminnotificationApiRepository
{
    public function getadminnotification();

    public function adminmarkasreadnotification();

    public function getadminnotificationdetails();

    public function getadminpushnotificationdetails();

}
