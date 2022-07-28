<?php

use App\Http\Controllers\UserController;
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

Route::prefix('users')->name('users.')->group(function () {
    Route::get('/{user}', [UserController::class, 'show'])->name('show');
    Route::post('/{user}/update', [UserController::class, 'update'])->name('update');
    Route::get('/{user}/comment', [UserController::class, 'create'])->name('create');
});

