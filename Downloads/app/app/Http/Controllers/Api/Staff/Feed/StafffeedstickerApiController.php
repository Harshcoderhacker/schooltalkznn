<?php

namespace App\Http\Controllers\Api\Staff\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Staff\Interfacelayer\Feed\IStafffeedstickerApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class StafffeedstickerApiController extends BaseController
{
    public $staffstickerapi;

    public function __construct(IStafffeedstickerApiRepository $staffstickerapi)
    {
        $this->staffstickerapi = $staffstickerapi;
    }

    public function staffgetallfeedsticker(Request $request)
    {
        try {
            $data = $this->staffstickerapi->staffgetallfeedsticker();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: staff_api_staffgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: staff_api_staffgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: staff_api_staffgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
