<?php

namespace App\Http\Controllers\Api\Parent\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedpostApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ParentfeedpostApiController extends BaseController
{
    public $parentfeedapi;

    public function __construct(IParentfeedpostApiRepository $parentfeedapi)
    {
        $this->parentfeedapi = $parentfeedapi;
    }

    public function parentcreatefeedpost(Request $request)
    {
        try {
            DB::beginTransaction();

            if (request()->hasFile('video')) {
                $validator = Validator::make($request->all(), [
                    'post' => 'bail|required|max:1300',
                    'type' => 'bail|required|integer',
                    "poll" => 'bail|required_if:type,==,3',
                    'video' => 'bail|nullable|mimetypes:video/x-ms-asf,video/x-flv,video/mp4,application/x-mpegURL,video/MP2T,video/3gpp,video/quicktime,video/x-msvideo,video/x-ms-wmv,video/avi|max:10240',
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

            $data = $this->parentfeedapi->parentcreatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentcreatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentupdatefeedpost(Request $request)
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

            $data = $this->parentfeedapi->parentupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1], 403);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetallfeedpost()
    {
        try {
            $data = $this->parentfeedapi->parentgetallfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetallfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetmyfeedpost()
    {
        try {
            $data = $this->parentfeedapi->parentgetmyfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetmyfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetmyclassfeedpost()
    {
        try {
            $data = $this->parentfeedapi->parentgetmyclassfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetmyclassfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetmyclassfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetmyclassfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetalltrendingfeedpost()
    {
        try {
            $data = $this->parentfeedapi->parentgetalltrendingfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetalltrendingfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetbyuuidfeedpost(Request $request)
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

            $data = $this->parentfeedapi->parentgetbyuuidfeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetbyuuidfeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentstatusupdatefeedpost(Request $request)
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

            $data = $this->parentfeedapi->parentstatusupdatefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentstatusupdatefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentdeletefeedpost(Request $request)
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

            $data = $this->parentfeedapi->parentdeletefeedpost();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentdeletefeedpost  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
