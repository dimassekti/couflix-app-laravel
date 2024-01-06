<?php

use App\Http\Controllers\Admin\MovieController;
use App\Http\Controllers\Admin\TransactionController;
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



// prefix generate /admin pada url
Route::group(['prefix' => 'admin'], function () {
  Route::view('/', 'admin.dashboard')->name('admin.dashboard');

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

// Route::get('/', function () {
//     return view('welcome');
// });
