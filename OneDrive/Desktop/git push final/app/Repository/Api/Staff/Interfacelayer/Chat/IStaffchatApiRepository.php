<?php

namespace App\Repository\Api\Staff\Interfacelayer\Chat;

interface IStaffchatApiRepository
{
    public function staffchatrecentlist();

    public function staffchatgrouplist();

    public function staffchatcontactlist();

    public function staffchatgroupfilter();

    public function staffchatgroupwisemessagelist();

    public function staffchatgroupparticipantlist();

    public function staffchatmessagesent();

    public function staffchatmessageupdateread();
}
