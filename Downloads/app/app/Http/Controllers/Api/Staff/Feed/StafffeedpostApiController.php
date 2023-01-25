<?php

namespace App\Http\Controllers\Api\Staff\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedpostApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class StafffeedpostApiController extends BaseController
{
    public $stafffeedapi;

    public function __construct(IStafffeedpostApiRepository $stafffeedapi)
    {
        $this->stafffeedapi = $stafffeedapi;
    }

    public function staffcreatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            if (request()->hasFile('video')) {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                    'video' => 'bail|nullable|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:1024000',
                    'idealibrary_uuid' => 'bail|nullable|string|max:50',
                ]);
                request()->is_mediatype = 2;

            } else if (request()->hasFile('images1')) {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                    'idealibrary_uuid' => 'bail|nullable|string|max:50',
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
                    'idealibrary_uuid' => 'bail|nullable|string|max:50',
                ]);
                request()->is_mediatype = 0;
            }

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError($validator->errors()->first());
                // return $this->sendError('Validation Error.', $validator->errors());
            }

            $hashtagvalidator['hashtag'] = explode(',', $request->hashtag);

            if ($hashtagvalidator['hashtag'] && count($hashtagvalidator['hashtag']) > 0) {
                $validatortwo = Validator::make($hashtagvalidator, [
                    "hashtag" => 'array|max:4', // As per requirements : max:4
                ]);

                if ($validatortwo->fails()) {
                    DB::rollback();
                    return $this->sendError($validatortwo->errors()->first());
                    // return $this->sendError('Validation Error.', $validatortwo->errors());
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

            $data = $this->stafffeedapi->staffcreatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffupdatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'bail|required|string|max:50',
                'post' => 'bail|required|max:255',
                'type' => 'bail|required|integer',
                'image' => 'bail|nullable|image|mimes:jpeg,png,jpg,svg,gif',
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

            $data = $this->stafffeedapi->staffupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1], 403);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetallfeedpost()
    {
        try {
            $data = $this->stafffeedapi->staffgetallfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetmyfeedpost()
    {
        try {
            $data = $this->stafffeedapi->staffgetmyfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetalltrendingfeedpost()
    {
        try {
            $data = $this->stafffeedapi->staffgetalltrendingfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffgetbyuuidfeedpost(Request $request)
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

            $data = $this->stafffeedapi->staffgetbyuuidfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffstatusupdatefeedpost(Request $request)
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

            $data = $this->stafffeedapi->staffstatusupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffdeletefeedpost(Request $request)
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

            $data = $this->stafffeedapi->staffdeletefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
