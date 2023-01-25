<?php

namespace App\Http\Controllers\Api\Admin\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostcommentApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminfeedcommentApiController extends BaseController
{
    public $admincommentapi;

    public function __construct(IAdminfeedpostcommentApiRepository $admincommentapi)
    {
        $this->admincommentapi = $admincommentapi;
    }

    public function admincreatefeedpostcomment(Request $request)
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

            $data = $this->admincommentapi->admincreatefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admincreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admincreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admincreatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminupdatefeedpostcomment(Request $request)
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

            $data = $this->admincommentapi->adminupdatefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminupdatefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingetallcommentbypostuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->admincommentapi->admingetallcommentbypostuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetallcommentbypostuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminfeedpostcommentstatusupdate(Request $request)
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

            $data = $this->admincommentapi->adminfeedpostcommentstatusupdate();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminfeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminfeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminfeedpostcommentstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admindeletefeedpostcomment(Request $request)
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

            $data = $this->admincommentapi->admindeletefeedpostcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admindeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admindeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admindeletefeedpostcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
