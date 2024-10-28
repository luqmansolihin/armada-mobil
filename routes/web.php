<?php

use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\LoginController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::prefix('cms')->group(function () {
    Route::get('/', function () {
        return auth()->check() ? to_route('cms.dashboard.index') : to_route('login');
    })->name('home');

    Route::middleware('guest')->group(function () {
        Route::get('/login', [LoginController::class, 'index'])->name('login');
        Route::post('/login', [LoginController::class, 'store'])->name('cms.login.process');
    });

    Route::middleware('auth')->group(function () {
        Route::post('/logout', [LoginController::class, 'destroy'])->name('logout');

        Route::get('/dashboard', [DashboardController::class, 'index'])->name('cms.dashboard.index');

        Route::prefix('banners')->group(function () {
            Route::get('/', [BannerController::class, 'index'])->name('cms.banners.index');
            Route::get('/create', [BannerController::class, 'create'])->name('cms.banners.create');
            Route::post('/store', [BannerController::class, 'store'])->name('cms.banners.store');
            Route::get('/{id}/edit', [BannerController::class, 'edit'])->name('cms.banners.edit');
            Route::put('/{id}/update', [BannerController::class, 'update'])->name('cms.banners.update');
            Route::delete('/{id}', [BannerController::class, 'destroy'])->name('cms.banners.delete');
        });
    });
});
