<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\language\LanguageController;
use App\Http\Controllers\pages\HomePage;
use App\Http\Controllers\pages\Page2;
use App\Http\Controllers\pages\MiscError;
use App\Http\Controllers\authentications\LoginBasic;
use App\Http\Controllers\authentications\RegisterBasic;

// Main Page Route
Route::get('/', function () {
    return view('landing.index');
})->name('landing');

Route::get('/page-2', [Page2::class, 'index'])->name('pages-page-2');

// locale
Route::get('/lang/{locale}', [LanguageController::class, 'swap']);
Route::get('/pages/misc-error', [MiscError::class, 'index'])->name('pages-misc-error');

// authentication
Route::get('/admin/login', [LoginBasic::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginBasic::class, 'login'])->name('admin.login.post');
Route::post('/admin/logout', [LoginBasic::class, 'logout'])->name('admin.logout');

// Protected Admin Routes
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/dashboard', [Page2::class, 'index'])->name('admin.dashboard');
    // Tambahkan route admin lainnya di sini
});

// Old authentication path compatibility if needed or redirect
Route::get('/auth/login-basic', function () {
    return redirect()->route('admin.login');
})->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
