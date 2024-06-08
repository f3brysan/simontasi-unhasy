<?php

use App\Http\Controllers\AdminProposalController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GetDataAPISiakad;
use App\Http\Controllers\LogBookController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\SyncDataController;
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

    Route::get('setting/users', [UserController::class, 'index']);
    Route::get('setting/users/{id}', [UserController::class, 'show']);
    Route::post('setting/users/store', [UserController::class, 'store']);

    Route::get('admin/data/proposal', [AdminProposalController::class, 'index']);
    Route::get('admin/data/proposal/detil/{id}', [AdminProposalController::class, 'detil']);
    Route::post('admin/data/proposal/store-penguji', [AdminProposalController::class, 'storePenguji']);
    Route::post('admin/data/proposal/delete-penguji', [AdminProposalController::class, 'deletePenguji']);
    Route::post('admin/data/proposal/store-pembimbing', [AdminProposalController::class, 'storePembimbing']);
    
    Route::get('admin/data/proposal/get/dosen-pembimbing/{id}', [AdminProposalController::class, 'getDosenPembimbing']);
    Route::get('admin/data/proposal/get/jadwal-sidang/{id}', [AdminProposalController::class, 'getJadwalSidang']);
    Route::post('admin/data/proposal/store/jadwal-sidang', [AdminProposalController::class, 'storeJadwalSidang']);
    Route::get('admin/data/proposal/get/jadwal-sidang/{id}', [AdminProposalController::class, 'getJadwalSidang']);
});


Route::middleware(['auth:web', 'role:mahasiswa|superadmin|pengelola'])->group(function () {
    Route::get('daftar/proposal', [ProposalController::class, 'index']);    
    Route::post('daftar/proposal/store', [ProposalController::class, 'storeProposal']);
    Route::get('daftar/proposal/get-judul/{id}', [ProposalController::class, 'getJudul']);
    Route::post('daftar/proposal/berkas/store', [ProposalController::class, 'storeBerkasProposal']);
});

Route::middleware(['auth:web', 'role:superadmin|mahasiswa|dosen|pengelola'])->group(function () {
    Route::get('log-book/get/{id}', [LogBookController::class, 'getLogBook']);
    Route::get('log-book/show-detil/{id}', [LogBookController::class, 'getDetilLogBook']);
    Route::delete('log-book/delete-detil/{id}', [LogBookController::class, 'deleteDetilLogBookMhs']);
    Route::post('log-book/store', [LogBookController::class, 'storeLogBook']);

    Route::get('dosen/log-bimbingan', [LogBookController::class, 'getDosenLogBook']);
    Route::get('dosen/log-bimbingan/detil/{id}', [LogBookController::class, 'getDetilLogBookMhs']);
    Route::get('dosen/log-bimbingan/approve/{id}', [LogBookController::class, 'approveDetilLogBookMhs']);
    Route::get('dosen/proposal/approval-dosen/{id}', [ProposalController::class, 'approvalProposalDosen']);
});

Route::get('sync/prodi', [SyncDataController::class, 'syncDataProdi']);
Route::get('sync/dosen', [SyncDataController::class, 'syncDataDosen']);