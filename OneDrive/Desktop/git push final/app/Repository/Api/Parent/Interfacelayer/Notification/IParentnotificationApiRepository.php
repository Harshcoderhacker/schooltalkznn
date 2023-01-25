<?php

namespace App\Repository\Api\Parent\Interfacelayer\Notification;

interface IParentnotificationApiRepository
{
    public function getparentnotification();

    public function parentmarkasreadnotification();

    public function getparentnotificationdetails();

    public function getparentpushnotificationdetails();

}
