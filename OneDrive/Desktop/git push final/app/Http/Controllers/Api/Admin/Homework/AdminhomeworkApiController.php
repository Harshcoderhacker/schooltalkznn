<?php

namespace App\Http\Controllers\Api\Admin\Homework;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Homework\IAdminhomeworkApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminhomeworkApiController extends BaseController
{
    public $adminhomeworkapi;

    public function __construct(IAdminhomeworkApiRepository $adminhomeworkapi)
    {
        $this->adminhomeworkapi = $adminhomeworkapi;
    }

    public function admingetrecenthomeworklist()
    {
        try {
            $data = $this->adminhomeworkapi->admingetrecenthomeworklist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admingetrecenthomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admingetrecenthomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admingetrecenthomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminclasssectionwisesubjectlist(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'class_uuid' => 'bail|required|max:50',
                'section_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->adminhomeworkapi->adminclasssectionwisesubjectlist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminclasssectionwisesubjectlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminclasssectionwisesubjectlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminclasssectionwisesubjectlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminsubjectwisehomeworklist(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'assignsubject_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->adminhomeworkapi->adminsubjectwisehomeworklist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminsubjectwisehomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminsubjectwisehomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminsubjectwisehomeworklist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminstudentwisehomeworkdetails(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'homework_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->adminhomeworkapi->adminstudentwisehomeworkdetails();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: adminstudentwisehomeworkdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: adminstudentwisehomeworkdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: adminstudentwisehomeworkdetails  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminsubjectwisehomeworkpost(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'assignsubject_uuid' => 'bail|required|string|max:50',
                'due_date' => 'bail|required|date|after:yesterday',
                'marks' => 'bail|required|integer|max:100',
                'attachment' => 'nullable|mimes:doc,docx,pdf,jpg,png|max:10240',
                'title' => 'bail|required|min:3|max:60',
                'description' => 'bail|required|string|max:1300',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminhomeworkapi->adminsubjectwisehomeworkpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminsubjectwisehomeworkpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminsubjectwisehomeworkpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminsubjectwisehomeworkpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admindownloadhomeworkattachment(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'homework_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            return $this->adminhomeworkapi->admindownloadhomeworkattachment();

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admindownloadhomeworkattachment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admindownloadhomeworkattachment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admindownloadhomeworkattachment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admindownloadstudenthomework(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'homeworklist_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            return $this->adminhomeworkapi->admindownloadstudenthomework();

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admindownloadstudenthomework  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admindownloadstudenthomework  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admindownloadstudenthomework  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminupdatehomeworkstatus(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'homeworklist_uuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminhomeworkapi->adminupdatehomeworkstatus();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminupdatehomeworkstatus  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminupdatehomeworkstatus  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminupdatehomeworkstatus  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingethomeworkcommentlistbyuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'homeworklist_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->adminhomeworkapi->admingethomeworkcommentlistbyuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admingethomeworkcommentlistbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admingethomeworkcommentlistbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admingethomeworkcommentlistbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminposthomeworkcomment(Request $request)
    {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->all(), [
                'homeworklist_uuid' => 'bail|required|string|max:50',
                'body' => 'bail|required|string|max:255',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminhomeworkapi->adminposthomeworkcomment();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminposthomeworkcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminposthomeworkcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminposthomeworkcomment  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
