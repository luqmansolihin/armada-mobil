<?php

use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\BlogController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\LoginController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController as ContentProfileController;
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

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/profile', [ContentProfileController::class, 'index'])->name('profile');

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

        Route::prefix('profiles')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('cms.profiles.index');
            Route::put('/update', [ProfileController::class, 'update'])->name('cms.profiles.update');
        });

        Route::prefix('blogs')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('cms.blogs.index');
            Route::get('/create', [BlogController::class, 'create'])->name('cms.blogs.create');
            Route::post('/store', [BlogController::class, 'store'])->name('cms.blogs.store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('cms.blogs.edit');
            Route::put('/{id}/update', [BlogController::class, 'update'])->name('cms.blogs.update');
            Route::delete('/{id}', [BlogController::class, 'destroy'])->name('cms.blogs.delete');
        });
    });
});
