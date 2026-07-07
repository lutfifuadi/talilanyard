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
    $rawProducts = \App\Models\Product::with('prices')->where('is_active', true)->get();
    $products = $rawProducts->map(fn($p) => [
        'id' => $p->id,
        'nama' => $p->name,
        'hargaMulai' => $p->prices->first()?->price_per_pcs ?? 0,
        'prices' => $p->prices
    ]);

    $rawAccessories = \App\Models\Accessory::where('is_active', true)->get();
    $accessories = $rawAccessories->map(fn($a) => [
        'id' => $a->id,
        'nama' => $a->name,
        'harga' => $a->price
    ]);

    $calculatorWidthOptions = json_decode(\App\Models\Setting::getValue('calculator_width_options'), true) ?: [];
    $calculatorMoq = \App\Models\Setting::getValue('calculator_moq', 40);
    
    return view('landing.index', compact('products', 'accessories', 'calculatorWidthOptions', 'calculatorMoq'));
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
    Route::get('/admin/dashboard', \App\Livewire\Admin\DashboardStats::class)->name('admin.dashboard');
    Route::get('/admin/products', \App\Livewire\Admin\ProductManager::class)->name('admin.products');
    Route::get('/admin/accessories', \App\Livewire\Admin\AccessoryManager::class)->name('admin.accessories');
    Route::get('/admin/settings', \App\Livewire\Admin\SettingManager::class)->name('admin.settings');
    Route::get('/admin/order-logs', \App\Livewire\Admin\OrderLogReporter::class)->name('admin.order-logs');
});

// AJAX route for storing OrderLog and getting WA Redirect URL
Route::post('/admin/order-logs/store', [\App\Http\Controllers\OrderLogController::class, 'store'])->name('admin.order-logs.store');

// Old authentication path compatibility if needed or redirect
Route::get('/auth/login-basic', function () {
    return redirect()->route('admin.login');
})->name('auth-login-basic');
Route::get('/auth/register-basic', [RegisterBasic::class, 'index'])->name('auth-register-basic');
