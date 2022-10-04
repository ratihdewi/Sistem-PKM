<?php

use App\Enums\DocumentStatus;
use App\Http\Controllers\Admin\DaftarUsulanController;
use App\Http\Controllers\Admin\JenisPKMController;
use App\Http\Controllers\Admin\PengaturanReviewerController;
use App\Http\Controllers\Admin\SkemaPKMController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dosen\ReviewProposalController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Mahasiswa\LaporanAkhir\DeleteLaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanAkhir\SubmitLaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\LaporanKemajuan\DeleteLaporanKemajuanController;
use App\Http\Controllers\Mahasiswa\LaporanKemajuan\SubmitLaporanKemajuanController;
use App\Http\Controllers\Mahasiswa\LaporanKemajuanController;
use App\Http\Controllers\Mahasiswa\ProposalController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout.post');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/index', HomePageController::class)->name('index');

    Route::group(['middleware' => 'role:Admin'], function () {
        Route::get('/daftar-usulan', [DaftarUsulanController::class, 'index'])->name('daftar-usulan.index');

        Route::resources([
            '/pengaturan-reviewer' => PengaturanReviewerController::class,
            '/jenis-pkm' => JenisPKMController::class,
            '/skema-pkm' => SkemaPKMController::class
        ], [
            'except' => ['show']
        ]);
    });

    Route::group(['middleware' => 'role:Dosen'], function () {
        Route::get('/proposal/review', [ReviewProposalController::class, 'index'])->name('review.index');
    });

    Route::group(['middleware' => 'role:Mahasiswa'], function () {
        Route::get('/proposal/skema-pkm/{parent_id}', [ProposalController::class, 'skema_pkm'])->name('skema');

        Route::resources([
            '/proposal' => ProposalController::class,
        ], [
            'parameters' => [
                'proposal' => 'document',
            ]
        ]);

        Route::group(['prefix' => 'laporan'], function () {
            Route::get('', [LaporanController::class, 'index'])->name('laporan.index');
            Route::get('{document}', [LaporanController::class, 'show'])->name('laporan.show');
        });

        Route::group(['prefix' => 'laporan-kemajuan'], function () {
            Route::get('{document}/create', [LaporanController::class, 'create'])->name('laporan-kemajuan.create');
            Route::put('{document}', SubmitLaporanKemajuanController::class)->name('laporan-kemajuan.submit');
            Route::delete('{document}', DeleteLaporanKemajuanController::class)->name('laporan-kemajuan.delete');
        });

        Route::group(['prefix' => 'laporan-akhir'], function () {
            Route::get('{document}/create', [LaporanController::class, 'create'])->name('laporan-akhir.create');
            Route::put('{document}', SubmitLaporanAkhirController::class)->name('laporan-akhir.submit');
            Route::delete('{document}', DeleteLaporanAkhirController::class)->name('laporan-akhir.delete');
        });
    });
});
