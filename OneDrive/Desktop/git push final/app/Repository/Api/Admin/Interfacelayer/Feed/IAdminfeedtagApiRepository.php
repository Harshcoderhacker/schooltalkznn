<?php

namespace App\Repository\Api\Admin\Interfacelayer\Feed;

interface IAdminfeedtagApiRepository
{
    public function admingethashtaglist();

    public function adminsearchhashtag();

    public function admingetfeedpostbyhashtaguuid();

    public function adminhashtagstatusupdate();

    public function adminhashtagdelete();
}
