<?php

use App\Http\Controllers\Admin\AdminGenreController;
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
        Route::resource('authors', AuthorController::class);
    });
});

require __DIR__.'/auth.php';
