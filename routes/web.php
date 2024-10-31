<?php

use App\Http\Controllers\BlogController as ContentBlogController;
use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\BlogController;
use App\Http\Controllers\CMS\BrochureController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\LoginController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\CMS\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController as ContentProductController;
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

Route::prefix('blogs')->group(function () {
    Route::get('/', [ContentBlogController::class, 'index'])->name('blogs.index');
    Route::get('/{slug}', [ContentBlogController::class, 'show'])->name('blogs.show');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ContentProductController::class, 'index'])->name('products.index');
    Route::get('/{slug}', [ContentProductController::class, 'show'])->name('products.show');
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

        Route::prefix('products')->group(function () {
            Route::get('/', [ProductController::class, 'index'])->name('cms.products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('cms.products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('cms.products.store');
            Route::get('/{id}/edit', [ProductController::class, 'edit'])->name('cms.products.edit');
            Route::put('/{id}/update', [ProductController::class, 'update'])->name('cms.products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('cms.products.delete');
        });

        Route::prefix('brochures')->group(function () {
            Route::get('/', [BrochureController::class, 'index'])->name('cms.brochures.index');
            Route::get('/create', [BrochureController::class, 'create'])->name('cms.brochures.create');
            Route::post('/store', [BrochureController::class, 'store'])->name('cms.brochures.store');
            Route::get('/{id}/edit', [BrochureController::class, 'edit'])->name('cms.brochures.edit');
            Route::put('/{id}/update', [BrochureController::class, 'update'])->name('cms.brochures.update');
            Route::delete('/{id}', [BrochureController::class, 'destroy'])->name('cms.brochures.delete');
        });

        Route::prefix('testimonials')->group(function () {
            Route::get('/', [TestimonialController::class, 'index'])->name('cms.testimonials.index');
            Route::get('/create', [TestimonialController::class, 'create'])->name('cms.testimonials.create');
            Route::post('/store', [TestimonialController::class, 'store'])->name('cms.testimonials.store');
            Route::get('/{id}/edit', [TestimonialController::class, 'edit'])->name('cms.testimonials.edit');
            Route::put('/{id}/update', [TestimonialController::class, 'update'])->name('cms.testimonials.update');
            Route::delete('/{id}', [TestimonialController::class, 'destroy'])->name('cms.testimonials.delete');
        });
    });
});
