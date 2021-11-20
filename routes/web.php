<?php

use App\Http\Controllers\MutualController;
use App\Http\Controllers\UserListController;
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

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [UserListController::class, 'index'])->name('dashboard');
    Route::get('/user/list', [UserListController::class, 'userlist'])->name('user.list');
    Route::get('/like/{id}', [MutualController::class, 'like'])->name('mutual.like');
    Route::get('/dislike/{id}', [MutualController::class, 'dislike'])->name('mutual.dislike');
    Route::get('show/map', [MutualController::class, 'map'])->name('show.map');
});

require __DIR__.'/auth.php';
