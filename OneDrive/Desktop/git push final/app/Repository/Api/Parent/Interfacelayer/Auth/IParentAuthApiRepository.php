<?php

namespace App\Repository\Api\Parent\Interfacelayer\Auth;

interface IParentAuthApiRepository
{
    public function login();

    public function parentcreatedevicetoken();

    public function verifyOtp();

    public function logout();

    public function isstudentactive();

}
