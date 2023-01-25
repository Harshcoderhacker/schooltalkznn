<?php

namespace App\Repository\Api\Parent\Interfacelayer\Feed;

interface IParentfeedpostApiRepository
{
    public function parentcreatefeedpost();

    public function parentupdatefeedpost();

    public function parentgetallfeedpost();

    public function parentgetmyfeedpost();

    public function parentgetmyclassfeedpost();

    public function parentgetalltrendingfeedpost();

    public function parentgetbyuuidfeedpost();

    public function parentstatusupdatefeedpost();

    public function parentdeletefeedpost();
}
