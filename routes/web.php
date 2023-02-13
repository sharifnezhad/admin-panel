<?php

use App\Http\Controllers\auth\LoginController;
use App\Http\Controllers\auth\RegisterController;
use App\Http\Controllers\auth\RoleController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\PostTypeController;
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
    return view('welcome');
});
Route::prefix('manager')->group(function (){
    Route::get('login', [LoginController::class, 'index'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::get('register', [RegisterController::class, 'index'])->name('register');
    Route::post('register', [RegisterController::class, 'register']);

    Route::middleware('auth')->group(function (){
        Route::get('/', DashbordController::class)->name('home');
        Route::middleware(['checkPostType'])->resource('posttype/{name}', PostTypeController::class);
    });

});
