<?php

namespace App\Repository\Api\Parent\Interfacelayer\Chat;

interface IParentchatApiRepository
{
    public function parentchatrecentlist();

    public function parentchatgrouplist();

    public function parentchatcontactlist();

    public function parentchatgroupfilter();

    public function parentchatgroupwisemessagelist();

    public function parentchatgroupparticipantlist();

    public function parentchatmessagesent();

    public function parentchatmessageupdateread();
}
