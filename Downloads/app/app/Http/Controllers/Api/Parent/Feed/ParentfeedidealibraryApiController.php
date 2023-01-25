<?php

namespace App\Http\Controllers\Api\Parent\Feed;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Parent\Interfacelayer\Feed\IParentfeedidealibraryApiRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Validator;

class ParentfeedidealibraryApiController extends BaseController
{
    public $parentidealibraryapi;

    public function __construct(IParentfeedidealibraryApiRepository $parentidealibraryapi)
    {
        $this->parentidealibraryapi = $parentidealibraryapi;
    }

    public function parentgetidealibrarylist(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'idea_category' => 'bail|required|numeric|gt:0|max:4',
            ], [
                'idea_category.gt' => 'Invalid category',
                'idea_category.max' => 'Invalid category',
            ]);
            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }
            $data = $this->parentidealibraryapi->parentgetidealibrarylist();
            return ($data[0]) ? $this->sendResponse($data[1], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: parent_api_parentgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: parent_api_parentgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: parent_api_parentgetidealibrarylist  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
