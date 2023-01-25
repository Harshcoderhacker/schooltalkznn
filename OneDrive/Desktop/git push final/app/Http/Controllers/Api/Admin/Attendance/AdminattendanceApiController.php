<?php

namespace App\Http\Controllers\Api\Admin\Attendance;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Attendance\IAdminattendanceApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class AdminattendanceApiController extends BaseController
{
    public $attendanceapi;

    public function __construct(IAdminattendanceApiRepository $attendanceapi)
    {
        $this->attendanceapi = $attendanceapi;
    }

    public function adminstudentattendancelist(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'classuuid' => 'bail|required|max:50',
                'attendance_date' => 'bail|required|date',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->attendanceapi->adminstudentattendancelist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminstudentattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminstudentattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminstudentattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminstaffattendancelist(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'designation_uuid' => 'bail|required|max:50',
                'attendance_date' => 'bail|required|date',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->attendanceapi->adminstaffattendancelist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminstaffattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminstaffattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminstaffattendancelist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminleaveapplicationlist(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'type' => 'bail|required|string|max:10',
                'attendance_date' => 'bail|required|date',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->attendanceapi->adminleaveapplicationlist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminleaveapplicationlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminleaveapplicationlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminleaveapplicationlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminleavestatusupdate(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'staffleaverequestuuid' => 'bail|required|max:50',
                'status' => 'bail|required|boolean',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->attendanceapi->adminleavestatusupdate();

            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminleavestatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminleavestatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminleavestatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
