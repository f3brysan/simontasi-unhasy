<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('login', [AuthController::class, 'auth']);
Route::post('logout', [AuthController::class, 'logout']);

Route::middleware(['auth:web'])->group(function () {
    Route::get('/', [DashboardController::class, 'index']);
});

Route::middleware(['auth:web', 'role:superadmin|pengelola'])->group(function () {
    Route::get('proposal/approve/{id}', [ProposalController::class, 'approveDosenProposal']);
});


Route::middleware(['auth:web', 'role:superadmin'])->group(function () {
    Route::get('setting/users', [UserController::class, 'index']);
    Route::get('setting/users/{id}', [UserController::class, 'show']);
    Route::post('setting/users/store', [UserController::class, 'store']);
});

Route::middleware(['auth:web', 'role:mahasiswa'])->group(function () {
    Route::get('daftar/proposal', [ProposalController::class, 'index']);
    Route::post('daftar/proposal/store', [ProposalController::class, 'storeProposal']);
});
