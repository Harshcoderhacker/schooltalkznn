<?php

namespace App\Repository\Api\Parent\Interfacelayer\Profile;

interface IParentProfileApiRepository
{
    public function getprofile();

    public function updateprofile($data);

    public function changepassword();

    public function changeavatar();
}
