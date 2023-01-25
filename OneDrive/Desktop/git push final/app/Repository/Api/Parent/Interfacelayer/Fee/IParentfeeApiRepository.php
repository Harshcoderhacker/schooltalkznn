<?php

namespace App\Repository\Api\Parent\Interfacelayer\Fee;

interface IParentfeeApiRepository
{
    public function parentfeeindex();

    public function parentpendingfeelist();

    public function parentfeepayonline();

    public function parentfeepaymentstore();

    public function parentfeepaymentinformation();

    public function parentfeepaymenthistory();

    public function parentfeepaymentdownload();

    public function parentfeequery();
}
