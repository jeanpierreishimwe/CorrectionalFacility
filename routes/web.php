<?php

use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\Auth\SocialLoginController;
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
    return view('welcome');
});

Route::get('auth/{provider}/redirect', [SocialLoginController::class,'redirect'])->name('auth.sociliate.redirect');
Route::get('auth/{provider}/callback',[SocialLoginController::class,'callback'])->name('auth.sociliate.callback');
