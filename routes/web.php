<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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



use App\Http\Controllers\BookController;

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::resource('books', BookController::class);
});
// User routes
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// // Admin routes
// Route::prefix('admin')->name('admin.')->group(function () {
//     Route::get('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'showLoginForm'])->name('login');
//     Route::post('/login', [App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
//     Route::get('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
//     Route::post('/register', [App\Http\Controllers\Admin\Auth\RegisterController::class, 'register']);
//     Route::get('/dashboard', function () {
//         return view('admin.dashboard');
//     })->middleware('admin')->name('dashboard');
// });

require __DIR__.'/auth.php';
