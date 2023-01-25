<?php

namespace App\Http\Controllers\Api\Parent\Auth;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Auth\IParentAuthApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class ParentauthApiController extends BaseController
{
    public $authapi;

    public function __construct(IParentAuthApiRepository $authapi)
    {
        $this->authapi = $authapi;
    }

    public function login(Request $request)
    {
        try {
            if ($request->email) {
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email|exists:aparents,email',
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    'phone' => 'bail|required|numeric|digits:10|exists:aparents,phone',
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
            Log::error('Exception one: parent_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error('Exception two: parent_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error('Exception three: parent_api_login - Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function verifyOtp(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'email' => 'required|email|exists:aparents,email',
                'otp' => 'required'
            ]);

            if ($validator->fails()) {
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

    public function parentcreatedevicetoken(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'token' => 'bail|required|string',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->authapi->parentcreatedevicetoken();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error('Exception one: parent_api_parentcreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error('Exception two: parent_api_parentcreatedevicetoken - Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error('Exception three: parent_api_parentcreatedevicetoken - Error: ' . $e->getMessage());
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

            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : parent_api_ogout');
            $data = $this->authapi->logout();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_ogout  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_ogout  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_ogout  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function isstudentactive()
    {
        try {

            Log::info("SessionID: " . substr(request()->header('authorization'), -33) . ' Function : student_api_isstudentactive');
            $data = $this->authapi->isstudentactive();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);
        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: student_api_isstudentactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: student_api_isstudentactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: student_api_isstudentactive  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
