<?php

namespace App\Repository\Api\Admin\Interfacelayer\Auth;

interface IAdminAuthApiRepository
{
    public function login();

    public  function verifyOtp();

    public function admincreatedevicetoken();

    public function logout();

    public function isadminactive();

}
