<?php

namespace App\Http\Controllers\Api\Admin\Staff\Staff;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Staff\Staff\IAdminstaffApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminstaffApiController extends BaseController
{
    public $staffdepartmentapi;

    public function __construct(IAdminstaffApiRepository $staffdepartmentapi)
    {
        $this->staffdepartmentapi = $staffdepartmentapi;
    }

    public function getstaffbydepartmentuuid(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'department_uuid' => 'bail|required',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffdepartmentapi->getstaffbydepartmentuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_updateprofile  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_updateprofile  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_updateprofile  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
