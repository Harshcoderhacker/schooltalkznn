<?php

namespace App\Repository\Api\Staff\Interfacelayer\Feed;

interface IStafffeedreportedApiRepository
{
    public function staffgetallfeedreportedpost();

    public function staffgetallreportedbypostuuid();

    public function stafffeedreportedpoststatusupdate();
}
