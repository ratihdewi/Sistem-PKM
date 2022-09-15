<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProposalController;
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

Route::get('/test', function () {
    return view('test');
});

Route::get('/login', [AuthController::class, 'index'])->name('login.get')->middleware('guest');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout.post');

Route::get('/index', function () {
    return view('page.index');
});

Route::resources([
    '/proposal' => ProposalController::class,
]);

