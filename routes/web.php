<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\UserChangePassword;
use App\Http\Controllers\BookReportController;
use App\Http\Controllers\UserSettingsController;
use App\Http\Controllers\CheckoutGuestController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Admin\AdminBookController;
use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminUsersController;
use App\Http\Controllers\Admin\AdminAuthorController;
use App\Http\Controllers\Admin\AdminDashboardController;

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
Route::name('books.')->group(function () {
    Route::group(['middleware' => 'auth', 'prefix' => 'book'], function () {
        Route::get('create', [BookController::class, 'create'])->name('create');
        Route::post('store', [BookController::class, 'store'])->name('store');
        Route::post('review/{book}', [ReviewController::class, 'store'])->name('review.store');
        Route::get('{book:slug}/report/create', [BookReportController::class, 'create'])->name('report.create');
        Route::post('{book}/report', [BookReportController::class, 'store'])->name('report.store');
    });
    Route::get('book/{book:slug}', [BookController::class, 'show'])->name('show');
});

Route::post('checkout/guest/{book:slug}', [CheckoutGuestController::class, 'show'])->middleware('guest')->name('checkout.guest');
Route::post('checkout/guest/{book:slug}/pay', [CheckoutGuestController::class, 'store'])->middleware('guest')->name('checkout.guest.store');
Route::view('checkout/authenticate', 'checkout.auth')->middleware('guest')->name('checkout.auth');
Route::get('checkout/{book:slug}', [CheckoutController::class, 'store'])->middleware('checkout')->name('checkout');
Route::view('success', 'checkout.success')->middleware('guest')->name('success');
Route::stripeWebhooks('stripe/webhook');

Route::group(['middleware' => 'auth', 'prefix' => 'user', 'as' => 'user.'], function () {
    Route::get('books', [BookController::class, 'index'])->name('books.list');
    Route::get('books/{book:slug}/edit', [BookController::class, 'edit'])->name('books.edit');
    Route::put('books/{book:slug}', [BookController::class, 'update'])->name('books.update');
    Route::delete('books/{book}', [BookController::class, 'destroy'])->name('books.destroy');

    Route::get('orders', [OrderController::class, 'index'])->name('orders.index');

    Route::view('settings', 'front.user.settings')->name('settings');
    Route::post('settings/{user}', [UserSettingsController::class, 'update'])->name('settings.update');
    Route::post('settings/password/change/{user}', [UserChangePassword::class, 'update'])->name('password.update');
});

Route::group(['middleware' => 'isAdmin', 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', AdminDashboardController::class)->name('index');

    Route::resource('books', AdminBookController::class);
    Route::put('book/approve/{book}', [AdminBookController::class, 'approveBook'])->name('books.approve');
    Route::resource('genres', AdminGenreController::class);
    Route::resource('authors', AdminAuthorController::class);
    Route::resource('users', AdminUsersController::class);
});

Route::get('auth/{provider}', [SocialiteController::class, 'redirectToProvider'])->name('auth.socialite');
Route::get('auth/{provider}/callback', [SocialiteController::class, 'handleProviderCallback']);

require __DIR__ . '/auth.php';
