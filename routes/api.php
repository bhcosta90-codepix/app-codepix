<?php

use App\Http\Controllers\Api\{
    AccountController,
    BankController,
    PixKeyController
};
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

Route::post('/bank', [BankController::class, 'store']);

Route::group(['middleware' => 'auth.basic'], function(){
    Route::post('/account', [AccountController::class, 'store']);
    Route::post('/pixkey/{account}', [PixKeyController::class, 'store']);
});
