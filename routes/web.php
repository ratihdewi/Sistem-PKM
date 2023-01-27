<?php

use App\Http\Controllers\Admin\DaftarUsulanController;
use App\Http\Controllers\Admin\DataDosenPendampingController;
use App\Http\Controllers\Admin\DataMahasiswaController;
use App\Http\Controllers\Admin\Master\JenisPKMController;
use App\Http\Controllers\Admin\Master\JenisSuratController;
use App\Http\Controllers\Admin\Master\ProdiController;
use App\Http\Controllers\Admin\Master\SkemaPKMController;
use App\Http\Controllers\Admin\Master\TahunAkademikController;
use App\Http\Controllers\Admin\PengaturanDokumenController;
use App\Http\Controllers\Admin\PengaturanReviewerController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Dosen\ReviewProposalController;
use App\Http\Controllers\Dosen\SubmitLaporanAkhirReviewController;
use App\Http\Controllers\Dosen\SubmitLaporanKemajuanReviewController;
use App\Http\Controllers\Dosen\SubmitProposalReviewController;
use App\Http\Controllers\DownloadFileController;
use App\Http\Controllers\ExportBudgetController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\Mahasiswa\LaporanAkhir\DeleteLaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanAkhir\SubmitLaporanAkhirController;
use App\Http\Controllers\Mahasiswa\LaporanController;
use App\Http\Controllers\Mahasiswa\LaporanKemajuan\DeleteLaporanKemajuanController;
use App\Http\Controllers\Mahasiswa\LaporanKemajuan\SubmitLaporanKemajuanController;
use App\Http\Controllers\Mahasiswa\ProposalController;
use App\Http\Controllers\Mahasiswa\RincianPengeluaranController;
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

    Route::group(['prefix' => 'download'], function () {
        Route::get('activity_document/{file}', [DownloadFileController::class, 'dokumen_kegiatan'])->name('download-activity-document');
        Route::get('/bukti_transaksi/{file}', [DownloadFileController::class, 'bukti_transaksi'])->name('download-bukti-transaksi');
    });

    Route::group(['prefix' => 'export'], function () {
        Route::get('laporan_kemajuan_budgets/{document_id}', [ExportBudgetController::class, 'laporan_kemajuan'])->name('kemajuan-budgets.export');
        Route::get('laporan_akhir_budgets/{document_id}', [ExportBudgetController::class, 'laporan_akhir'])->name('akhir-budgets.export');
    });

    Route::group(['middleware' => 'role:Admin'], function () {
        Route::group(['prefix' => 'daftar-usulan'], function () {
            Route::get('', [DaftarUsulanController::class, 'index'])->name('daftar-usulan.index');
            Route::post('add-reviewer', [DaftarUsulanController::class, 'add_reviewer'])->name('daftar-usulan.add-reviewer');
            Route::delete('delete-reviewer', [DaftarUsulanController::class, 'delete_reviewer'])->name('daftar-usulan.delete-reviewer');
            Route::get('reviewers', [DaftarUsulanController::class, 'reviewers'])->name('daftar-usulan.reviewers'); //AJAX
            Route::get('document/{document_id}', [DaftarUsulanController::class, 'document'])->name('daftar-usulan.document'); //AJAX
        });

        Route::group(['prefix' => 'pengumuman'], function () {
            Route::get('create', [PengumumanController::class, 'create'])->name('pengumuman.create');
            Route::post('submit', [PengumumanController::class, 'submit'])->name('pengumuman.submit');
        });
        Route::group(['prefix' => 'pengaturan-dokumen'], function () {
            Route::get('create', [PengaturanDokumenController::class, 'create'])->name('pengaturan-dokumen.create');
            Route::post('submit', [PengaturanDokumenController::class, 'submit'])->name('pengaturan-dokumen.submit');
        });
        Route::resource('data-mahasiswa', DataMahasiswaController::class)->only(['index']);
        Route::resource('data-dosen-pendamping', DataDosenPendampingController::class)->only(['index']);
        Route::resource('pengaturan-reviewer', PengaturanReviewerController::class)->except(['show', 'edit', 'update']);
        Route::resource('prodi', ProdiController::class)->only(['index']);
        Route::resource('tahun-akademik', TahunAkademikController::class)->except(['show']);
        Route::resource('jenis-surat', JenisSuratController::class)->only(['index']);
        Route::resource('jenis-pkm', JenisPKMController::class)->only(['index']);
        Route::resource('skema-pkm', SkemaPKMController::class)->except(['show']);

        Route::post('jenis-pkm/change-status', [JenisPKMController::class, 'change_status'])->name('jenis-pkm.change-status'); //AJAX
    });

    Route::group(['middleware' => 'role:Dosen'], function () {
        Route::get('/review', [ReviewProposalController::class, 'index'])->name('review.index');
        Route::get('/review/proposal/{document}', [ReviewProposalController::class, 'proposal'])->name('review.proposal');
        Route::post('/review/proposal/{document}', SubmitProposalReviewController::class)->name('review.submit-proposal');
        Route::get('/review/laporan_kemajuan/{document}', [ReviewProposalController::class, 'laporan_kemajuan'])->name('review.laporan-kemajuan');
        Route::post('/review/laporan_kemajuan/{document}', SubmitLaporanKemajuanReviewController::class)->name('review.submit-laporan-kemajuan');
        Route::get('/review/laporan_akhir/{document}', [ReviewProposalController::class, 'laporan_akhir'])->name('review.laporan-akhir');
        Route::post('/review/laporan_akhir/{document}', SubmitLaporanAkhirReviewController::class)->name('review.submit-laporan-akhir');
    });

    Route::group(['middleware' => 'role:Mahasiswa'], function () {
        Route::get('/proposal/skema-pkm/{parent_id}', [ProposalController::class, 'skema_pkm'])->name('skema'); //AJAX
        Route::get('/proposal/mahasiswa', [ProposalController::class, 'mahasiswa'])->name('mahasiswa'); //AJAX

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
            Route::get('{document}/edit', [LaporanController::class, 'edit'])->name('laporan-kemajuan.edit');
            Route::put('{document}', SubmitLaporanKemajuanController::class)->name('laporan-kemajuan.submit');
            Route::delete('{document}', DeleteLaporanKemajuanController::class)->name('laporan-kemajuan.delete');
        });

        Route::group(['prefix' => 'laporan-akhir'], function () {
            Route::get('{document}/create', [LaporanController::class, 'create'])->name('laporan-akhir.create');
            Route::get('{document}/edit', [LaporanController::class, 'edit'])->name('laporan-akhir.edit');
            Route::put('{document}', SubmitLaporanAkhirController::class)->name('laporan-akhir.submit');
            Route::delete('{document}', DeleteLaporanAkhirController::class)->name('laporan-akhir.delete');
        });

        Route::group(['prefix' => 'pengeluaran'], function () {
            Route::post('', [RincianPengeluaranController::class, 'create'])->name('pengeluaran.create');
            Route::post('edit', [RincianPengeluaranController::class, 'update'])->name('pengeluaran.update');
            Route::delete('{item}', [RincianPengeluaranController::class, 'delete'])->name('pengeluaran.delete');
        });
    });
});
