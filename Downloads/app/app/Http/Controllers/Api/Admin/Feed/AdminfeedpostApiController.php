<?php

namespace App\Http\Controllers\Api\Admin\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpostApiRepository;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminfeedpostApiController extends BaseController
{
    public $adminfeedapi;

    public function __construct(IAdminfeedpostApiRepository $adminfeedapi)
    {
        $this->adminfeedapi = $adminfeedapi;
    }

    public function admincreatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            if (request()->hasFile('video')) {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                    'video' => 'bail|required|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:1024000',
                ]);
                request()->is_mediatype = 2;

            } else if (request()->hasFile('images1')) {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                    'images1' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images2' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images3' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images4' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images5' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images6' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images7' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images8' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images9' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                    'images10' => 'bail|nullable|mimes:jpeg,png,jpg,svg,gif|max:10240',
                ]);
                request()->is_mediatype = 1;
            } else {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                ]);
                request()->is_mediatype = 0;
            }

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError($validator->errors()->first());
            }

            $hashtagvalidator['hashtag'] = explode(',', $request->hashtag);

            if ($hashtagvalidator['hashtag'] && count($hashtagvalidator['hashtag']) > 0) {
                $validatortwo = Validator::make($hashtagvalidator, [
                    "hashtag" => 'array|max:4', // As per requirements : max:4
                ]);

                if ($validatortwo->fails()) {
                    DB::rollback();
                    // return $this->sendError('Validation Error.', $validatortwo->errors());
                    return $this->sendError($validatortwo->errors()->first());
                }
            }

            if ($request->type == 3) {
                //it wont work in rest client cause of flutter which send us the array in string format remove json_decode for rest client
                $pollvalidator['poll'] = json_decode($request->poll);
                $validatorthree = Validator::make($pollvalidator, [
                    "poll" => 'array|min:2',
                ]);

                if ($validatorthree->fails()) {
                    DB::rollback();
                    return $this->sendError($validatorthree->errors()->first());
                    // return $this->sendError('Validation Error.', $validatorthree->errors());
                }
            }

            $data = $this->adminfeedapi->admincreatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admincreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admincreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admincreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminupdatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
                'post' => 'bail|required|max:255',
                'type' => 'bail|required|integer',

                // 'post' => 'required_if:type,==,3|required_if:type,==,2',
                //'image' => 'required_if:type,==,1|image|mimes:jpeg,png,jpg,svg,gif',
                // 'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,svg,gif',
                // "poll" => 'bail|required_if:type,==,3',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $hashtagvalidator['hashtag'] = explode(',', $request->hashtag);

            if ($hashtagvalidator['hashtag'] && count($hashtagvalidator['hashtag']) > 0) {
                $validatortwo = Validator::make($hashtagvalidator, [
                    "hashtag" => 'array|max:4', // As per requirements : max:4
                ]);

                if ($validatortwo->fails()) {
                    DB::rollback();
                    return $this->sendError('Validation Error.', $validatortwo->errors());
                }
            }

            // For update not required
            // if ($request->type == 3) {
            //     //it wont work in rest client cause of flutter which send us the array in string format remove json_decode for rest client
            //     $pollvalidator['poll'] = json_decode($request->poll);
            //     $validatorthree = Validator::make($pollvalidator, [
            //         "poll" => 'array|min:2',
            //     ]);

            //     if ($validatorthree->fails()) {
            //         DB::rollback();
            //         return $this->sendError('Validation Error.', $validatorthree->errors());
            //     }
            // }

            $data = $this->adminfeedapi->adminupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingetallfeedpost()
    {
        try {
            Log::info("-------admingetallfeedpost------" . Carbon::now()->toDateTimeString());

            $data = $this->adminfeedapi->admingetallfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingetmyfeedpost()
    {
        try {
            $data = $this->adminfeedapi->admingetmyfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingetalltrendingfeedpost()
    {
        try {
            $data = $this->adminfeedapi->admingetalltrendingfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admingetbyuuidfeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminfeedapi->admingetbyuuidfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminstatusupdatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
                'active' => 'bail|required|boolean',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminfeedapi->adminstatusupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function admindeletefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminfeedapi->admindeletefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admindeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admindeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admindeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
