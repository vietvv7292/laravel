<?php

use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/product/list', [ApiController::class, 'list']);
Route::post('/product/update/{id}', [ApiController::class, 'update']);
Route::post('/option/list', [ApiController::class, 'option_list']);
Route::post('/option/add', [ApiController::class, 'option_add']);
Route::post('/option/edit/{id}', [ApiController::class, 'option_edit']);