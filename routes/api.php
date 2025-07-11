<?php

use App\Http\Controllers\API\API_NilaiAkhirController;
use App\Http\Controllers\GetDataAPISiakad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/get-nilai-akhir', [API_NilaiAkhirController::class, 'getNilaiAkhir']);
Route::post('v1/void-transaction', [GetDataAPISiakad::class, 'void']);
