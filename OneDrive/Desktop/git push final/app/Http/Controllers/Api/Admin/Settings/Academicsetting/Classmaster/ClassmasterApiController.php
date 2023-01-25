<?php

namespace App\Http\Controllers\Api\Admin\Settings\Academicsetting\Classmaster;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Classmaster\IClassmasterApiRepository;
use Illuminate\Http\Request;

class ClassmasterApiController extends BaseController
{
    public $classmasterapi;

    public function __construct(IClassmasterApiRepository $classmasterapi)
    {
        $this->classmasterapi = $classmasterapi;
    }

    public function getallclassmaster()
    {
        try {
            $data = $this->classmasterapi->getallclassmaster();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_classmaster  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_classmaster  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_classmaster  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
