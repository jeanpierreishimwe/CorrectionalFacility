<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/token/login',[AuthController::class,'login']);
Route::post('/token/register',[AuthController::class,'register']);

//protected routing

Route::group(['middleware' => ['auth:sanctum']], function(){
    Route::post('/logout',[AuthController::class,'logout']);
    Route::resource('/tasks',TasksController::class);
});