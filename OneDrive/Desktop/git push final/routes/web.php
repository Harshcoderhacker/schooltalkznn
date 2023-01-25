<?php

use App\Events\Testsss;
use App\Http\Controllers\Web\Admin\Auth\AdminauthController;
use Illuminate\Support\Facades\Route;

Route::get('/broadcast', function () {
    broadcast(new Testsss());
    return 'success';
});

Route::get('logs', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
Route::get('/{panel?}', [AdminauthController::class, 'homeloginpage'])->name('homeloginpage');

Route::get('sockets/serve', function () {
    \Illuminate\Support\Facades\Artisan::call('websockets:serve');
});
