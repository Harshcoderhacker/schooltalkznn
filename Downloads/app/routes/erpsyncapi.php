<?php

use App\Http\Controllers\Api\Erpsync\ErpsyncController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function () {
    Route::post('erpsync', [ErpsyncController::class, 'erpsync'])->name('erpsync');
});
