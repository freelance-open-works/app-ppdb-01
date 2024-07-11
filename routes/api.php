<?php

use App\Http\Controllers\Default\Api\_SelectTableController;
use App\Http\Controllers\Default\FileController;
use App\Http\Middleware\JwtCustomApiVerification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware(JwtCustomApiVerification::class)->group(function () {
    Route::get('/_select/{table}', _SelectTableController::class)->name('api.select.table');
    Route::post('files', [FileController::class, 'store'])->name('api.file.store');
});
