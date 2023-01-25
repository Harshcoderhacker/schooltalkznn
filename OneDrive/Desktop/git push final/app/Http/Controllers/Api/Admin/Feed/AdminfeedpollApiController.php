<?php

namespace App\Http\Controllers\Api\Admin\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedpollApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminfeedpollApiController extends BaseController
{
    public $adminfeedpollvoteapi;

    public function __construct(IAdminfeedpollApiRepository $adminfeedpollvoteapi)
    {
        $this->adminfeedpollvoteapi = $adminfeedpollvoteapi;
    }

    public function adminfeedpolltoggle(Request $request)
    {
        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpolluuid' => 'bail|required|string|max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminfeedpollvoteapi->adminfeedpolltoggle();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminfeedpolltoggle  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminfeedpolltoggle  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminfeedpolltoggle  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
