<?php

use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(ClientController::class)->prefix('clients')->group(function () {
    Route::post('/', 'store');
    Route::get('/', 'index');
});
