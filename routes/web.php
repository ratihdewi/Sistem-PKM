<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Feature\ProposalController;
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
    Route::get('/index', function () {
        return view('page.index');
    })->name('index');

    Route::group(['middleware' => 'role:Mahasiswa'], function () {
        Route::get('/proposal/skema-pkm/{parent_id}', [ProposalController::class, 'skema_pkm'])->name('skema');
        Route::resources([
            '/proposal' => ProposalController::class,
        ], [
            'parameters' => [
                'proposal' => 'document'
            ]
        ]);
    });
});
