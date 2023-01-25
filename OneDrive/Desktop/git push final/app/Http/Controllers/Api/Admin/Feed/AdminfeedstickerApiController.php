<?php

namespace App\Http\Controllers\Api\Admin\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Feed\IAdminfeedstickerApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminfeedstickerApiController extends BaseController
{
    public $adminstickerapi;

    public function __construct(IAdminfeedstickerApiRepository $adminstickerapi)
    {
        $this->adminstickerapi = $adminstickerapi;
    }

    public function admingetallfeedsticker()
    {
        try {
            $data = $this->adminstickerapi->admingetallfeedsticker();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_admingetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_admingetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_admingetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
