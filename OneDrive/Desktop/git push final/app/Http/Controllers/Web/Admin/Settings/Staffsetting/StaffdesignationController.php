<?php

namespace App\Http\Controllers\Web\Admin\Settings\Staffsetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Staffsetting\Staffdesignation;
use Illuminate\Http\Request;

class StaffdesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/settings/staffsettings/designation/index');
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
     * @param  \App\Models\Admin\Settings\Staffsetting\Staffdesignation  $staffdesignation
     * @return \Illuminate\Http\Response
     */
    public function show(Staffdesignation $staffdesignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Staffsetting\Staffdesignation  $staffdesignation
     * @return \Illuminate\Http\Response
     */
    public function edit(Staffdesignation $staffdesignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Staffsetting\Staffdesignation  $staffdesignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staffdesignation $staffdesignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Staffsetting\Staffdesignation  $staffdesignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staffdesignation $staffdesignation)
    {
        //
    }
}
