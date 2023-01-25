<?php

namespace App\Repository\Api\Admin\Interfacelayer\Feed;

interface IAdminfeedreportedApiRepository
{
    public function admingetallfeedreportedpost();

    public function admingetallreportedbypostuuid();

    public function adminfeedreportedpoststatusupdate();
}
