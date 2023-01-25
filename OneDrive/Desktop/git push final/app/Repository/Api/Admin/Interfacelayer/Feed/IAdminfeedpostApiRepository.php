<?php

namespace App\Repository\Api\Admin\Interfacelayer\Feed;

interface IAdminfeedpostApiRepository
{
    public function admincreatefeedpost();

    public function adminupdatefeedpost();

    public function admingetallfeedpost();

    public function admingetmyfeedpost();

    public function admingetalltrendingfeedpost();

    public function admingetbyuuidfeedpost();

    public function adminstatusupdatefeedpost();

    public function admindeletefeedpost();
}
