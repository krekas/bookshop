<?php

use App\Http\Controllers\Dashboard\GenreController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use Illuminate\Routing\RouteGroup;

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

Route::get('/', HomeController::class)->name('home');

Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin'], function () {
    Route::name('admin.')->group(function () {
        Route::view('/', 'admin.index')->name('index');
        
        Route::resource('genres', GenreController::class);
        // Route::get('genres', [GenreController::class, 'index'])->name('genres.index');
        // Route::view('genres/create', 'admin.genres.create')->name('genres.create');
        // Route::post('genres/store', [GenreController::class, 'store'])->name('genres.store');
        // Route::get('genres/{genre}/edit', [GenreController::class, 'edit'])->name('genres.edit');
        // Route::put('genres/{genre}/update', [GenreController::class, 'update'])->name('genres.update');
        // Route::get('genres/{genre}/destroy', [GenreController::class, 'destroy'])->name('genres.destroy');
    });
});

require __DIR__.'/auth.php';
