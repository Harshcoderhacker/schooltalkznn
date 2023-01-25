<?php

namespace App\Repository\Api\Staff\Interfacelayer\Feed;

interface IStafffeedtagApiRepository
{
    public function staffgethashtaglist();

    public function staffsearchhashtag();

    public function staffgetfeedpostbyhashtaguuid();

}
