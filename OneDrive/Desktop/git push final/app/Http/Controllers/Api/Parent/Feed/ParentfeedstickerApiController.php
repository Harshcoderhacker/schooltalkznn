<?php

namespace App\Http\Controllers\Api\Parent\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedstickerApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ParentfeedstickerApiController extends BaseController
{
    public $parentstickerapi;

    public function __construct(IParentfeedstickerApiRepository $parentstickerapi)
    {
        $this->parentstickerapi = $parentstickerapi;
    }

    public function parentgetallfeedsticker()
    {
        try {
            $data = $this->parentstickerapi->parentgetallfeedsticker();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetallfeedsticker  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
