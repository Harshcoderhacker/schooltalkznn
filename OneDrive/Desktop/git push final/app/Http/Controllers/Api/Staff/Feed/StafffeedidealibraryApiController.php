<?php

namespace App\Http\Controllers\Api\Staff\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedidealibraryApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Validator;

class StafffeedidealibraryApiController extends BaseController
{
    public $staffidealibraryapi;

    public function __construct(IStafffeedidealibraryApiRepository $staffidealibraryapi)
    {
        $this->staffidealibraryapi = $staffidealibraryapi;
    }

    public function staffgetidealibrarylist()
    {
        try {
            $data = $this->staffidealibraryapi->staffgetidealibrarylist();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffselectidealibrary(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'idealibrary_uuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffidealibraryapi->staffselectidealibrary();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffselectidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffselectidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffselectidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function staffusedidealibrary()
    {
        try {
            $data = $this->staffidealibraryapi->staffusedidealibrary();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffusedidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffusedidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffusedidealibrary  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
