<?php

namespace App\Http\Controllers\Api\Admin\Payroll;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Payroll\IAdminpayrollApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class AdminpayrollApiController extends BaseController
{
    public $adminpayrollapi;

    public function __construct(IAdminpayrollApiRepository $adminpayrollapi)
    {
        $this->adminpayrollapi = $adminpayrollapi;
    }

    public function adminstaffpayrollbyuuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'staff_uuid' => 'required|string|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->adminpayrollapi->adminstaffpayrollbyuuid();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminstaffpayrollbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminstaffpayrollbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminstaffpayrollbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    // Not used Yet
    public function adminstaffpayrolldownloadbyuuid($uuid)
    {
        try {
            $pdf = $this->adminpayrollapi->adminstaffpayrolldownloadbyuuid($uuid);
            return $pdf->download('payslip.pdf');

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminstaffpayrolldownloadbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminstaffpayrolldownloadbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminstaffpayrolldownloadbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }

    public function adminstaffpayrollsendmailbyuuid($uuid)
    {
        try {
            $this->adminpayrollapi->adminstaffpayrollsendmailbyuuid($uuid);
        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_adminstaffpayrollsendmailbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_adminstaffpayrollsendmailbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_adminstaffpayrollsendmailbyuuid  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
