<?php

namespace App\Repository\Api\Admin\Interfacelayer\Chat;

interface IAdminchatApiRepository
{
    public function adminchatrecentlist();

    public function adminchatgrouplist();

    public function adminchatcontactlist();

    public function adminchatgroupfilter();

    public function adminchatgroupwisemessagelist();

    public function adminchatgroupparticipantlist();

    public function adminchatmessagesent();

    public function adminchatmessageupdateread();
}
