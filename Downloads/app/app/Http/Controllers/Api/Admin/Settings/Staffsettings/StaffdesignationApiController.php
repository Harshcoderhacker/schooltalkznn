<?php

namespace App\Http\Controllers\Api\Admin\Settings\Staffsettings;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Settings\Staffsettings\IStaffdesignationApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StaffdesignationApiController extends BaseController
{
    public $designationapi;

    public function __construct(IStaffdesignationApiRepository $designationapi)
    {
        $this->designationapi = $designationapi;
    }

    public function getallstaffdesignation()
    {
        try {
            $data = $this->designationapi->getallstaffdesignation();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_staffdesignation  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_staffdesignation  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_staffdesignation  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
