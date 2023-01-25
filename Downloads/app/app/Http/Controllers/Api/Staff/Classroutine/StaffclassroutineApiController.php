<?php

namespace App\Http\Controllers\Api\Staff\Classroutine;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Classroutine\IStaffclassroutineApiRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class StaffclassroutineApiController extends BaseController
{
    public $staffclassroutineapi;

    public function __construct(IStaffclassroutineApiRepository $staffclassroutineapi)
    {
        $this->staffclassroutineapi = $staffclassroutineapi;
    }

    public function getstaffclassrountine(Request $request)
    {
        // weekday must be in fullform with no captial letters
        // should be "monday", "tuesday"
        // should not be "Monday" or "mon"
        try {
            $validator = Validator::make($request->all(), [
                'weekday' => 'bail|required|max:10',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->staffclassroutineapi->getstaffclassrountine();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_getstaffclassrountine  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_getstaffclassrountine  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_getstaffclassrountine  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

}
