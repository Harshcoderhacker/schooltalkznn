<?php

namespace App\Http\Controllers\Web\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ColorSchemeController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    function switch (Request $request) {
            session([
                'color_scheme' => $request->color_scheme,
            ]);

            return back();
    }
}
