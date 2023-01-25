<?php

namespace App\Http\Controllers\Api\Parent\Emotioncapture;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Emotioncapture\IParentemotioncaptureApiRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class EmotioncaptureApiController extends BaseController
{
    public $parentemotionapi;

    public function __construct(IParentemotioncaptureApiRepository $parentemotionapi)
    {
        $this->parentemotionapi = $parentemotionapi;
    }

    public function parentstoreemotioncapture(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'emotion_status' => 'bail|required|integer|min:0|max:5',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentemotionapi->parentstoreemotioncapture();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentstoreemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentstoreemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentstoreemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentcheckemotioncapture()
    {
        try {
            $data = $this->parentemotionapi->parentcheckemotioncapture();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentcheckemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentcheckemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentcheckemotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentcalendaremotioncapture(Request $request)
    {
        try {

            $validator = Validator::make($request->all(), [
                'month' => 'bail|required|integer|Between:1,12',
                'year' => 'bail|required|integer|Between:' . (new Carbon("100 years ago"))->year . ',' . Carbon::now()->year,
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentemotionapi->parentcalendaremotioncapture();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parentcalendaremotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parentcalendaremotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parentcalendaremotioncapture  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

}
