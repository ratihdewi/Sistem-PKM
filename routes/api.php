<?php

use App\Http\Controllers\Master\MasterSkemaPKMController;
use App\Http\Controllers\Proposal\CreateProposalController;
use App\Http\Controllers\Proposal\EditProposalController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'proposal'], function () {
    Route::post('submit', CreateProposalController::class);
    Route::post('edit/{id}', EditProposalController::class);
});

Route::resources([
    'skema-pkm' => MasterSkemaPKMController::class
]);
