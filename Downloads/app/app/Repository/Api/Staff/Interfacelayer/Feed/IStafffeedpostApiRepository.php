<?php

namespace App\Repository\Api\Staff\Interfacelayer\Feed;

interface IStafffeedpostApiRepository
{
    public function staffcreatefeedpost();

    public function staffupdatefeedpost();

    public function staffgetallfeedpost();

    public function staffgetmyfeedpost();

    public function staffgetalltrendingfeedpost();

    public function staffgetbyuuidfeedpost();

    public function staffstatusupdatefeedpost();

    public function staffdeletefeedpost();
}
