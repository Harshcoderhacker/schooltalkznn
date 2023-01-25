<?php

namespace App\Http\Controllers\Api\Admin\Auth;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Auth\IAdminAuthApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminauthApiController extends BaseController
{
    public $authapi;

    public function __construct(IAdminAuthApiRepository $authapi)
    {
        $this->authapi = $authapi;
    }

    public function login(Request $request)
    {
        try {
            if ($request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:users,email',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'phone' => 'bail|required|numeric|digits:10|exists:users,phone',
                    // 'password' => 'bail|required|min:8',
                ]);
            }

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->login();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Validation Error.', ["password" => "Wrong password or this account not approved yet."]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:users,email',
                'otp' => 'required'
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->verifyOtp();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Validation Error.', ["password" => "Wrong password or this account not approved yet."]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: admin_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admincreatedevicetoken(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'token' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->admincreatedevicetoken();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error('Exception one: admin_api_admincreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: admin_api_admincreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: admin_api_admincreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'token' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : admin_api_logout');
            $data = $this->authapi->logout();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function isadminactive()
    {
        try {

            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : admin_api_isadminactive');
            $data = $this->authapi->isadminactive();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_isadminactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_isadminactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_isadminactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
