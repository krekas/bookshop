<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\AdminBooksController;
use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserChangePassword;
use App\Http\Controllers\UserSettingsController;

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
Route::get('/book/{book}', BookController::class)->name('book.show');

Route::group(['middleware' => 'auth', 'prefix' => 'user'], function () {
    Route::name('user.')->group(function () {
        Route::view('settings', 'front.user.settings')->name('settings');
        Route::post('settings/{user}', [UserSettingsController::class, 'update'])->name('settings.update');
        Route::post('settings/password/change/{user}', [UserChangePassword::class, 'update'])->name('password.update');
    });
});

Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin'], function () {
    Route::name('admin.')->group(function () {
        Route::get('/', AdminDashboardController::class)->name('index');
        
        Route::resource('books', AdminBooksController::class);
        Route::resource('genres', AdminGenreController::class);
        Route::resource('authors', AdminAuthorController::class);
    });
});

require __DIR__.'/auth.php';
