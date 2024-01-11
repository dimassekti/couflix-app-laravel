<?php

use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
use App\Http\Controllers\Member\DashboardController;
use App\Http\Controllers\Member\RegisterController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Member\LoginController as MemberLoginController;
use App\Http\Controllers\Member\MovieController as MemberMovieController;
use App\Http\Controllers\Member\PricingController;

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

Route::get('admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('admin/login', [LoginController::class, 'authenticate'])->name('admin.login.authenticate');

// prefix generate /admin pada url
Route::group(['prefix' => 'admin', 'middleware' => 'admin.auth'], function () {
  Route::view('/', 'admin.dashboard')->name('admin.dashboard');

  Route::get('logout', [LoginController::class, 'logout'])->name('admin.logout');

  Route::group(['prefix' => 'transaction'], function () {
    Route::get('/', [TransactionController::class, 'index'])->name('admin.transaction.index');
  });

  Route::group(['prefix' => 'movie'], function () {
    Route::get('/', [MovieController::class, 'index'])->name('admin.movie.index');
    Route::get('/create', [MovieController::class, 'create'])->name('admin.movie.create');
    Route::post('/store', [MovieController::class, 'store'])->name('admin.movie.store');
    Route::get('/edit/{id}', [MovieController::class, 'edit'])->name('admin.movie.edit');
    Route::put('/update/{id}', [MovieController::class, 'update'])->name('admin.movie.update');
    Route::delete('/delete/{id}', [MovieController::class, 'destroy'])->name('admin.movie.delete');
  });
});

Route::view('/', 'index');

Route::get('/register', [RegisterController::class, 'index'])->name('member.register');
Route::post('/register', [RegisterController::class, 'store'])->name('member.register.store');

Route::get('/login', [MemberLoginController::class, 'index'])->name('member.login');
Route::post('/login', [MemberLoginController::class, 'auth'])->name('member.login.auth');

Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

Route::group(['prefix' => 'member', 'middleware' => ['auth']], function () {
  Route::get('/', [DashboardController::class, 'index'])->name('member.dashboard');
  Route::get('/logout', [MemberLoginController::class, 'logout'])->name('member.logout');
  Route::get('/movie-detail{id}', [MemberMovieController::class, 'show'])->name('member.movie.detail');
});
