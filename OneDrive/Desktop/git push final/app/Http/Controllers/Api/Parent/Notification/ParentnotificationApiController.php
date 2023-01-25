<?php

namespace App\Http\Controllers\Api\Parent\Notification;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Notification\IParentnotificationApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ParentnotificationApiController extends BaseController
{
    public $parentnotificationapi;

    public function __construct(IParentnotificationApiRepository $parentnotificationapi)
    {
        $this->parentnotificationapi = $parentnotificationapi;
    }

    public function getparentnotification()
    {
        try {
            $data = $this->parentnotificationapi->getparentnotification();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_getparentnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_getparentnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_getparentnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentmarkasreadnotification()
    {
        try {
            $data = $this->parentnotificationapi->parentmarkasreadnotification();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentmarkasreadnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentmarkasreadnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentmarkasreadnotification  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getparentnotificationdetails(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'notification_uuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->parentnotificationapi->getparentnotificationdetails();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_getparentnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_getparentnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_getparentnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function getparentpushnotificationdetails(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'pushnotification_uuid' => 'bail|required|string|max:50',
                'type' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->parentnotificationapi->getparentpushnotificationdetails();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_getparentpushnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_getparentpushnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_getparentpushnotificationdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
