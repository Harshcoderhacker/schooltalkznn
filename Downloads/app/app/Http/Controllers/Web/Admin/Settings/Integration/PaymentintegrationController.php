<?php

namespace App\Http\Controllers\Web\Admin\Settings\Integration;

use App\Http\Controllers\Controller;
use App\Models\Admin\Settings\Integration\Paymentintegration;
use Illuminate\Http\Request;

class PaymentintegrationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.settings.integrationsettings.paymentintegration.index');
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
     * @param  \App\Models\Admin\Settings\Integration\Paymentintegration  $paymentintegration
     * @return \Illuminate\Http\Response
     */
    public function show(Paymentintegration $paymentintegration)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin\Settings\Integration\Paymentintegration  $paymentintegration
     * @return \Illuminate\Http\Response
     */
    public function edit(Paymentintegration $paymentintegration)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Admin\Settings\Integration\Paymentintegration  $paymentintegration
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paymentintegration $paymentintegration)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin\Settings\Integration\Paymentintegration  $paymentintegration
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paymentintegration $paymentintegration)
    {
        //
    }
}
