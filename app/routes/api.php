<?php

use App\Http\Controllers\Api\v1\Excel\ExcelController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::post('excel', [ExcelController::class, 'index']);