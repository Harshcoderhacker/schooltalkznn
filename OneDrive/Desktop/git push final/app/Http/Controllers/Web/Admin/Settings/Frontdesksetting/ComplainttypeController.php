<?php

namespace App\Http\Controllers\Web\Admin\Settings\Frontdesksetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Frontdesksetting\Complainttype;
use Illuminate\Http\Request;

class ComplainttypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.frontdesksettings.complainttype.index');
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
     * @param  \App\Models\Admin\Settings\Frontdesksetting\Complainttype  $complainttype
     * @return \Illuminate\Http\Response
     */
    public function show(Complainttype $complainttype)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Frontdesksetting\Complainttype  $complainttype
     * @return \Illuminate\Http\Response
     */
    public function edit(Complainttype $complainttype)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Frontdesksetting\Complainttype  $complainttype
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Complainttype $complainttype)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Frontdesksetting\Complainttype  $complainttype
     * @return \Illuminate\Http\Response
     */
    public function destroy(Complainttype $complainttype)
    {
        //
    }
}
