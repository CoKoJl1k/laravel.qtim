<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\RedisController;
use App\Http\Controllers\QueueController;
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

Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::resource('news', NewsController::class);


Route::get('redis', [RedisController::class,'index']);
Route::get('redis_set', [RedisController::class,'setKeyValue']);
Route::get('redis_get', [RedisController::class,'getValue']);


Route::get('queue', [QueueController::class,'index']);
Route::get('json_create', [QueueController::class,'create']);
Route::get('json_show', [QueueController::class,'show']);

/*
Route::controller(NewsController::class)->group(function () {
    Route::get('news/{news_id}/news', 'index');
    Route::get('news/{news_id}/news/{news_id}', 'show');
    Route::post('news/{news_id}/news', 'store');
    Route::put('news/{news_id}/news/{news_id}', 'update');
    Route::delete('news/{news_id}/news/{news_id}', 'destroy');
});
*/
