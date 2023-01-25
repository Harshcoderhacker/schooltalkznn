<?php

namespace App\Http\Controllers\Api\Staff\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostcommentApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class StafffeedcommentApiController extends BaseController
{
    public $staffcommentapi;

    public function __construct(IStafffeedpostcommentApiRepository $staffcommentapi)
    {
        $this->staffcommentapi = $staffcommentapi;
    }

    public function staffcreatefeedpostcomment(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
                'feedcomment' => 'bail|required|string',
                'commenttype' => 'bail|required|integer',
                'commenttype_uuid' => 'bail|nullable|string',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffcommentapi->staffcreatefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffcreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffcreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffcreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffupdatefeedpostcomment(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedcommentuuid' => 'bail|required|string|max:50',
                'feedcomment' => 'bail|required|string',
                'commenttype' => 'bail|required|integer',
                'commenttype_uuid' => 'bail|nullable|string',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffcommentapi->staffupdatefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetallcommentbypostuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffcommentapi->staffgetallcommentbypostuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function stafffeedpostcommentstatusupdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedcommentuuid' => 'bail|required|string|max:50',
                'active' => 'bail|required|boolean',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffcommentapi->stafffeedpostcommentstatusupdate();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_stafffeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_stafffeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_stafffeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffdeletefeedpostcomment(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedcommentuuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffcommentapi->staffdeletefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffdeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffdeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffdeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
