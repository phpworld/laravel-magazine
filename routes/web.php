<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MagazineController;
use App\Http\Controllers\Admin\PurchaseController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OptionsController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Frontend\MagazineController as FrontendMagazineController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PageController as FrontendPageController;
use App\Http\Controllers\Auth\GoogleController;

// Frontend Routes
Route::get('/', [FrontendMagazineController::class, 'home'])->name('home');
Route::get('/magazines', [FrontendMagazineController::class, 'index'])->name('magazines.index');
Route::get('/magazines/{magazine:slug}', [FrontendMagazineController::class, 'show'])->name('magazines.show');

Auth::routes();

// Google OAuth Routes
Route::get('/auth/google', [GoogleController::class, 'redirect'])->name('auth.google');
Route::get('/auth/google/callback', [GoogleController::class, 'callback'])->name('auth.google.callback');

Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('user.dashboard')->middleware(['auth', 'redirect.role']);

// Admin Routes
Route::middleware(['auth', 'admin', 'redirect.role'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('categories', CategoryController::class);
    Route::resource('magazines', MagazineController::class);
    Route::resource('purchases', PurchaseController::class);
    Route::patch('/purchases/{purchase}/status', [PurchaseController::class, 'updateStatus'])->name('purchases.update-status');
    Route::resource('users', UserController::class);
    Route::patch('/users/{user}/toggle-role', [UserController::class, 'toggleRole'])->name('users.toggle-role');
    
    // Banner Management Routes
    Route::resource('banners', BannerController::class);
    Route::patch('/banners/{banner}/toggle-status', [BannerController::class, 'toggleStatus'])->name('banners.toggle-status');
    Route::post('/banners/update-order', [BannerController::class, 'updateOrder'])->name('banners.update-order');
    
    // Options Management Routes
    Route::prefix('options')->name('options.')->group(function () {
        Route::get('/', [OptionsController::class, 'index'])->name('index');
        Route::patch('/general', [OptionsController::class, 'updateGeneral'])->name('update-general');
        Route::patch('/contact', [OptionsController::class, 'updateContact'])->name('update-contact');
        Route::patch('/social', [OptionsController::class, 'updateSocial'])->name('update-social');
        Route::patch('/media', [OptionsController::class, 'updateMedia'])->name('update-media');
        Route::patch('/banner', [OptionsController::class, 'updateBanner'])->name('update-banner');
        Route::delete('/remove-file', [OptionsController::class, 'removeFile'])->name('remove-file');
        Route::patch('/reset', [OptionsController::class, 'resetToDefaults'])->name('reset');
    });
    
    // Pages Management Routes
    Route::resource('pages', PageController::class);
});

// User Routes (authenticated)
Route::middleware(['auth'])->prefix('user')->name('user.')->group(function () {
    Route::get('/purchases', function() {
        $purchases = auth()->user()->purchases()
            ->with(['magazine', 'magazine.category'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('user.purchases', compact('purchases'));
    })->name('purchases');
});

// Payment Routes
Route::middleware(['auth'])->group(function () {
    Route::post('/payment/create-order', [PaymentController::class, 'createOrder'])->name('payment.create-order');
    Route::post('/payment/verify', [PaymentController::class, 'verifyPayment'])->name('payment.verify');
    Route::get('/magazine/download/{magazine_id}', [PaymentController::class, 'downloadMagazine'])->name('magazine.download');
});

// Redirect /admin to dashboard
Route::redirect('/admin', '/admin/dashboard');

// Frontend Pages Routes (should be last to avoid conflicts)
Route::get('/pages/{slug}', [FrontendPageController::class, 'show'])->name('pages.show');
