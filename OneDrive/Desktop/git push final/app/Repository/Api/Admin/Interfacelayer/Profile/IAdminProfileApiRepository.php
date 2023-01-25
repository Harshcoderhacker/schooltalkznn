<?php

namespace App\Repository\Api\Admin\Interfacelayer\Profile;

interface IAdminProfileApiRepository
{
    public function getprofile();

    public function updateprofile($data);

    public function changepassword();

    public function changeavatar();
}
