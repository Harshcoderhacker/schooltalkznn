<?php

namespace App\Http\Controllers\Api\Staff\Auth;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Auth\IStaffAuthApiRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class StaffauthApiController extends BaseController
{
    public $authapi;

    public function __construct(IStaffAuthApiRepository $authapi)
    {
        $this->authapi = $authapi;
    }

    public function login(Request $request)
    {
        try {
            //DB::beginTransaction();
            if ($request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:staff,email',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'phone' => 'bail|required|numeric|digits:10|exists:staff,phone',
                    // 'password' => 'bail|required|min:8',
                ]);
            }

            if ($validator->fails()) {
                //DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->login();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Validation Error.', ["password" => "Wrong password or this account not approved yet."]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error('Exception one: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:staff,email',
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
            Log::error('Exception one: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: staff_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffcreatedevicetoken(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'token' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->staffcreatedevicetoken();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error('Exception one: staff_api_staffcreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: staff_api_staffcreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: staff_api_staffcreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function logout(Request $request)
    {

        // dd('hyde');
        try {

            $validator = Validator::make($request->all(), [
                'token' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            DB::beginTransaction();
            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : staff_api_logout');
            $data = $this->authapi->logout();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_logout  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function isstaffactive()
    {
        try {

            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : staff_api_isstaffactive');
            $data = $this->authapi->isstaffactive();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_isstaffactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_isstaffactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_isstaffactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
