<?php

namespace App\Http\Controllers\Api\Staff\Exam\Offlineexam;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Exam\Offlineexam\IStaffexamApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class StaffexamApiController extends BaseController
{
    public $staffexamapi;

    public function __construct(IStaffexamApiRepository $staffexamapi)
    {
        $this->staffexamapi = $staffexamapi;
    }

    public function staffgetallexamlistbyclasssectionuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'classmastersection_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffexamapi->staffgetallexamlistbyclasssectionuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staffgetallexamlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staffgetallexamlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staffgetallexamlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetexamschedulebyexamuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exam_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffexamapi->staffgetexamschedulebyexamuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staffgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staffgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staffgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetstudentsmarklistbyclasssectionexamuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'classmastersection_uuid' => 'bail|required|max:50',
                'exam_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffexamapi->staffgetstudentsmarklistbyclasssectionexamuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staffgetstudentsmarklistbyclasssectionexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staffgetstudentsmarklistbyclasssectionexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staffgetstudentsmarklistbyclasssectionexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetstudentlistbyclasssectionuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'classmastersection_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffexamapi->staffgetstudentlistbyclasssectionuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetstudentlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetstudentlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetstudentlistbyclasssectionuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetallexammarkbystudentuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'student_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->staffexamapi->staffgetallexammarkbystudentuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staffgetallexammarkbystudentuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staffgetallexammarkbystudentuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staffgetallexammarkbystudentuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

}
