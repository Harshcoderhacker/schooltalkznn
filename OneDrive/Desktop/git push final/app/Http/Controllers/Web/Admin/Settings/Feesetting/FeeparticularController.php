<?php

namespace App\Http\Controllers\Web\Admin\Settings\Feesetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Feesetting\Feeparticular;
use Illuminate\Http\Request;

class FeeparticularController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.feesettings.feeparticular.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Fee\Feeparticular  $feeparticular
     * @return \Illuminate\Http\Response
     */
    public function show(Feeparticular $feeparticular)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Fee\Feeparticular  $feeparticular
     * @return \Illuminate\Http\Response
     */
    public function edit(Feeparticular $feeparticular)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Fee\Feeparticular  $feeparticular
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Feeparticular $feeparticular)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Fee\Feeparticular  $feeparticular
     * @return \Illuminate\Http\Response
     */
    public function destroy(Feeparticular $feeparticular)
    {
        //
    }
}
