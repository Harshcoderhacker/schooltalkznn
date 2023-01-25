<?php

namespace App\Repository\Api\Parent\Interfacelayer\Feed;

interface IParentfeedtagApiRepository
{
    public function parentgethashtaglist();

    public function parentsearchhashtag();

    public function parentgetfeedpostbyhashtaguuid();

}
