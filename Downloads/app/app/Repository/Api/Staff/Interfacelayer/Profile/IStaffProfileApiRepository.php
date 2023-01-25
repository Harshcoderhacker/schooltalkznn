<?php

namespace App\Repository\Api\Staff\Interfacelayer\Profile;

interface IStaffProfileApiRepository
{
    public function getprofile();

    public function updateprofile($data);

    public function changepassword();

    public function changeavatar();
}
