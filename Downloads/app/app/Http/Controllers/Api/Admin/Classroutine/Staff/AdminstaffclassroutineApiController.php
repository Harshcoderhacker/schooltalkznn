<?php

namespace App\Http\Controllers\Api\Admin\Classroutine\Staff;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Classroutine\Staff\IAdminstaffclassroutineApiRepository;
use Illuminate\Http\Request;
use Validator;

class AdminstaffclassroutineApiController extends BaseController
{
    public $classroutineapi;

    public function __construct(IAdminstaffclassroutineApiRepository $classroutineapi)
    {
        $this->classroutineapi = $classroutineapi;
    }

    public function getstaffclassroutinebystaffuuid(Request $request)
    {
        // weekday must be in fullform with no captial letters
        // should be "monday", "tuesday"
        // should not be "Monday" or "mon"
        try {
            $validator = Validator::make($request->all(), [
                'weekday' => 'bail|required|max:10',
                'staffuuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->classroutineapi->getstaffclassroutinebystaffuuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: getstaffclassroutinebystaffuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: getstaffclassroutinebystaffuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: getstaffclassroutinebystaffuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
