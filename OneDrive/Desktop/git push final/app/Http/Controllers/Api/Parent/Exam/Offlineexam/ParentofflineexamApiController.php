<?php

namespace App\Http\Controllers\Api\Parent\Exam\Offlineexam;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Exam\Offlineexam\IParentofflineexamApiRepository;
use Illuminate\Http\Request;
use Validator;

class ParentofflineexamApiController extends BaseController
{
    public $parentofflineexamapi;

    public function __construct(IParentofflineexamApiRepository $parentofflineexamapi)
    {
        $this->parentofflineexamapi = $parentofflineexamapi;
    }

    public function parentexamindex()
    {
        try {
            $data = $this->parentofflineexamapi->parentexamindex();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentexamindex  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentexamindex  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentexamindex  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetexamlist()
    {
        try {
            $data = $this->parentofflineexamapi->parentgetexamlist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentgetexamlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentgetexamlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentgetexamlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetexamschedulebyexamuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exam_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentofflineexamapi->parentgetexamschedulebyexamuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentgetexamschedulebyexamuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetallexamlistmonthwise()
    {
        try {
            $data = $this->parentofflineexamapi->parentgetallexamlistmonthwise();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentgetallexamlistmonthwise  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentgetallexamlistmonthwise  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentgetallexamlistmonthwise  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetexammarlist(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exam_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentofflineexamapi->parentgetexammarlist();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentgetexammarlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentgetexammarlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentgetexammarlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentgetprogresscard(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'exam_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentofflineexamapi->parentgetprogresscard();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentgetprogresscard  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentgetprogresscard  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentgetprogresscard  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

}
