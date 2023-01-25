<?php

namespace App\Http\Controllers\Api\Parent\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedreportedApiRepository;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ParentfeedreportedApiController extends BaseController
{
    public $parentreportapi;

    public function __construct(IParentfeedreportedApiRepository $parentreportapi)
    {
        $this->parentreportapi = $parentreportapi;
    }

    public function parentgetallfeedreportedlist()
    {
        try {
            $data = $this->parentreportapi->parentgetallfeedreportedlist();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetallfeedreportedlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetallfeedreportedlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetallfeedreportedlist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function parentfeedreportedstatusupdate(Request $request)
    {

        try {
            DB::beginTransaction();

            $validator = Validator::make($request->all(), [
                'feedpostuuid' => 'required|string|max:50',
                'feedreporteduuid' => 'required|string||max:50',
            ]);

            if ($validator->fails()) {
                DB::rollback();
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->parentreportapi->parentfeedreportedstatusupdate();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentfeedreportedstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentfeedreportedstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            DB::rollback();
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentfeedreportedstatusupdate  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
