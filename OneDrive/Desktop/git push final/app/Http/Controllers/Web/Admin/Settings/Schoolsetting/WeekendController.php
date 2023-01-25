<?php

namespace App\Http\Controllers\Web\Admin\Settings\Schoolsetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Schoolsetting\Weekend;
use Illuminate\Http\Request;

class WeekendController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.schoolsettings.weekend.index');
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
     * @param  \App\Models\Admin\Settings\Schoolsetting\Weekend  $weekend
     * @return \Illuminate\Http\Response
     */
    public function show(Weekend $weekend)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Schoolsetting\Weekend  $weekend
     * @return \Illuminate\Http\Response
     */
    public function edit(Weekend $weekend)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Schoolsetting\Weekend  $weekend
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Weekend $weekend)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Schoolsetting\Weekend  $weekend
     * @return \Illuminate\Http\Response
     */
    public function destroy(Weekend $weekend)
    {
        //
    }
}
