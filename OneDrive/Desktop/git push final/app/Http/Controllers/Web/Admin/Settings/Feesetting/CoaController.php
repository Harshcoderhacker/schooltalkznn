<?php

namespace App\Http\Controllers\Web\Admin\Settings\Feesetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Feesetting\Coa;
use Illuminate\Http\Request;

class CoaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.feesettings.coa.index');
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
     * @param  \App\Models\Admin\Settings\Fee\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function show(Coa $coa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Fee\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function edit(Coa $coa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Fee\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Coa $coa)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Fee\Coa  $coa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Coa $coa)
    {
        //
    }
}
