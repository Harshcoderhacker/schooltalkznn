<?php

namespace App\Http\Controllers\Api\Admin\Settings\Academicsetting\Section;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use App\Repository\Api\Admin\Interfacelayer\Settings\Academicsetting\Section\ISectionApiRepository;
use Illuminate\Http\Request;
use Validator;

class SectionApiController extends BaseController
{
    public $sectionapi;

    public function __construct(ISectionApiRepository $sectionapi)
    {
        $this->sectionapi = $sectionapi;
    }

    public function getsectionbyclassmasteruuid(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'classmaster_uuid' => 'bail|required|max:50',
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $data = $this->sectionapi->getsectionbyclassmasteruuid();
            return ($data[0]) ? $this->sendResponse($data[1], $data[2], 200) : $this->sendError('Error', $data[1]);

        } catch (Exception $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception one: admin_api_section  Error: ' . $e->getMessage());
            return $this->sendError('Exception one : ', $e->getMessage());
        } catch (QueryException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception two: admin_api_section  Error: ' . $e->getMessage());
            return $this->sendError('Exception two : ', $e->getMessage());
        } catch (PDOException $e) {
            Log::error("SessionID: " . substr(request()->header('authorization'), -33) . ' Exception three: admin_api_section  Error: ' . $e->getMessage());
            return $this->sendError('Exception three : ', $e->getMessage());
        }
    }
}
