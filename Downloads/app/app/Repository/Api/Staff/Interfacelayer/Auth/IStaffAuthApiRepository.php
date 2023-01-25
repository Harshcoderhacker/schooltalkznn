<?php

namespace App\Repository\Api\Staff\Interfacelayer\Auth;

interface IStaffAuthApiRepository
{
    public function login();

    public function staffcreatedevicetoken();

    public function verifyOtp();

    public function logout();

    public function isstaffactive();
}
