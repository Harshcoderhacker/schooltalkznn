<?php

namespace App\Http\Controllers\Api\Erpsync;

use App\Http\Controllers\Api\Helper\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ErpsyncController extends BaseController
{

    public function erpsync()
    {
        Log::info('-----------start erp sync---------');
        Log::info(json_encode(request()->all()));
        Log::info('-----------end erp sync---------');

        return response('erp data sync successfully', 200)
            ->header('Content-Type', 'text/plain');
    }

}
