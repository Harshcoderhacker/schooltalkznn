<?php

namespace App\Http\Controllers\Web\Admin\Settings\Schoolsetting;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Schoolsetting\Academicyear;
use Illuminate\Http\Request;

class AcademicyearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.schoolsettings.academicyear.index');
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
     * @param  \App\Models\Admin\Settings\Schoolsetting\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function show(Academicyear $academicyear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Schoolsetting\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function edit(Academicyear $academicyear)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Schoolsetting\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Academicyear $academicyear)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Schoolsetting\Academicyear  $academicyear
     * @return \Illuminate\Http\Response
     */
    public function destroy(Academicyear $academicyear)
    {
        //
    }
}
