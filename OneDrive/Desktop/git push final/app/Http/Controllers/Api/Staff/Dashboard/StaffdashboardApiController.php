<?php

namespace App\Http\Controllers\Api\Staff\Dashboard;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Dashboard\IStaffDashboardApiRepository;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StaffdashboardApiController extends BaseController
{
    public $dashboardapi;

    public function __construct(IStaffDashboardApiRepository $dashboardapi)
    {
        $this->dashboardapi = $dashboardapi;
    }

    public function dashboard(Request $request)
    {
        try {
            $data = $this->dashboardapi->dashboard();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_dashboard  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_dashboard  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_dashboard  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }

    }

}
