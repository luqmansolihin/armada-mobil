<?php

use App\Http\Controllers\BlogController as ContentBlogController;
use App\Http\Controllers\AfterSaleController as ContentAfterSaleController;
use App\Http\Controllers\CareerController as ContentCareerController;
use App\Http\Controllers\CMS\OutletController;
use App\Http\Controllers\PromotionController as ContentPromotionController;
use App\Http\Controllers\CMS\AfterSaleController;
use App\Http\Controllers\CMS\BannerController;
use App\Http\Controllers\CMS\BlogController;
use App\Http\Controllers\CMS\BrochureController;
use App\Http\Controllers\CMS\CareerController;
use App\Http\Controllers\CMS\ContactController;
use App\Http\Controllers\CMS\DashboardController;
use App\Http\Controllers\CMS\LoginController;
use App\Http\Controllers\CMS\OperationalHourController;
use App\Http\Controllers\CMS\ProductController;
use App\Http\Controllers\CMS\ProfileController;
use App\Http\Controllers\CMS\PromotionController;
use App\Http\Controllers\CMS\ServiceController;
use App\Http\Controllers\CMS\TestimonialController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OutletController as ContentOutletController;
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

Route::prefix('after-sales')->group(function () {
    Route::get('/', [ContentAfterSaleController::class, 'index'])->name('after-sales.index');
    Route::get('/{slug}', [ContentAfterSaleController::class, 'show'])->name('after-sales.show');
});

Route::prefix('promotions')->group(function () {
    Route::get('/', [ContentPromotionController::class, 'index'])->name('promotions.index');
    Route::get('/{slug}', [ContentPromotionController::class, 'show'])->name('promotions.show');
});

Route::prefix('products')->group(function () {
    Route::get('/', [ContentProductController::class, 'index'])->name('products.index');
    Route::get('/{slug}', [ContentProductController::class, 'show'])->name('products.show');
});

Route::get('/outlets', [ContentOutletController::class, 'index'])->name('outlets');

Route::prefix('careers')->group(function () {
    Route::get('/', [ContentCareerController::class, 'index'])->name('careers.index');
    Route::get('/{slug}', [ContentCareerController::class, 'show'])->name('careers.show');
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

        Route::prefix('operational-hours')->group(function () {
            Route::get('/', [OperationalHourController::class, 'index'])->name('cms.operational-hours.index');
            Route::get('/create', [OperationalHourController::class, 'create'])->name('cms.operational-hours.create');
            Route::post('/store', [OperationalHourController::class, 'store'])->name('cms.operational-hours.store');
            Route::get('/{id}/edit', [OperationalHourController::class, 'edit'])->name('cms.operational-hours.edit');
            Route::put('/{id}/update', [OperationalHourController::class, 'update'])->name('cms.operational-hours.update');
            Route::delete('/{id}', [OperationalHourController::class, 'destroy'])->name('cms.operational-hours.delete');
        });

        Route::prefix('after-sales')->group(function () {
            Route::get('/', [AfterSaleController::class, 'index'])->name('cms.after-sales.index');
            Route::get('/create', [AfterSaleController::class, 'create'])->name('cms.after-sales.create');
            Route::post('/store', [AfterSaleController::class, 'store'])->name('cms.after-sales.store');
            Route::get('/{id}/edit', [AfterSaleController::class, 'edit'])->name('cms.after-sales.edit');
            Route::put('/{id}/update', [AfterSaleController::class, 'update'])->name('cms.after-sales.update');
            Route::delete('/{id}', [AfterSaleController::class, 'destroy'])->name('cms.after-sales.delete');
        });

        Route::prefix('blogs')->group(function () {
            Route::get('/', [BlogController::class, 'index'])->name('cms.blogs.index');
            Route::get('/create', [BlogController::class, 'create'])->name('cms.blogs.create');
            Route::post('/store', [BlogController::class, 'store'])->name('cms.blogs.store');
            Route::get('/{id}/edit', [BlogController::class, 'edit'])->name('cms.blogs.edit');
            Route::put('/{id}/update', [BlogController::class, 'update'])->name('cms.blogs.update');
            Route::delete('/{id}', [BlogController::class, 'destroy'])->name('cms.blogs.delete');
        });

        Route::prefix('promotions')->group(function () {
            Route::get('/', [PromotionController::class, 'index'])->name('cms.promotions.index');
            Route::get('/create', [PromotionController::class, 'create'])->name('cms.promotions.create');
            Route::post('/store', [PromotionController::class, 'store'])->name('cms.promotions.store');
            Route::get('/{id}/edit', [PromotionController::class, 'edit'])->name('cms.promotions.edit');
            Route::put('/{id}/update', [PromotionController::class, 'update'])->name('cms.promotions.update');
            Route::delete('/{id}', [PromotionController::class, 'destroy'])->name('cms.promotions.delete');
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

        Route::prefix('contacts')->group(function () {
            Route::get('/', [ContactController::class, 'index'])->name('cms.contacts.index');
            Route::get('/create', [ContactController::class, 'create'])->name('cms.contacts.create');
            Route::post('/store', [ContactController::class, 'store'])->name('cms.contacts.store');
            Route::get('/{id}/edit', [ContactController::class, 'edit'])->name('cms.contacts.edit');
            Route::put('/{id}/update', [ContactController::class, 'update'])->name('cms.contacts.update');
            Route::delete('/{id}', [ContactController::class, 'destroy'])->name('cms.contacts.delete');
        });

        Route::prefix('services')->group(function () {
            Route::get('/', [ServiceController::class, 'index'])->name('cms.services.index');
            Route::get('/create', [ServiceController::class, 'create'])->name('cms.services.create');
            Route::post('/store', [ServiceController::class, 'store'])->name('cms.services.store');
            Route::get('/{id}/edit', [ServiceController::class, 'edit'])->name('cms.services.edit');
            Route::put('/{id}/update', [ServiceController::class, 'update'])->name('cms.services.update');
            Route::delete('/{id}', [ServiceController::class, 'destroy'])->name('cms.services.delete');
        });

        Route::prefix('outlets')->group(function () {
            Route::get('/', [OutletController::class, 'index'])->name('cms.outlets.index');
            Route::get('/create', [OutletController::class, 'create'])->name('cms.outlets.create');
            Route::post('/store', [OutletController::class, 'store'])->name('cms.outlets.store');
            Route::get('/{id}/edit', [OutletController::class, 'edit'])->name('cms.outlets.edit');
            Route::put('/{id}/update', [OutletController::class, 'update'])->name('cms.outlets.update');
            Route::delete('/{id}', [OutletController::class, 'destroy'])->name('cms.outlets.delete');
        });

        Route::prefix('careers')->group(function () {
            Route::get('/', [CareerController::class, 'index'])->name('cms.careers.index');
            Route::get('/create', [CareerController::class, 'create'])->name('cms.careers.create');
            Route::post('/store', [CareerController::class, 'store'])->name('cms.careers.store');
            Route::get('/{id}/edit', [CareerController::class, 'edit'])->name('cms.careers.edit');
            Route::put('/{id}/update', [CareerController::class, 'update'])->name('cms.careers.update');
            Route::delete('/{id}', [CareerController::class, 'destroy'])->name('cms.careers.delete');
        });
    });
});
