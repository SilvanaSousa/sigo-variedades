<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RedirectController;
use Illuminate\Support\Facades\Route;

/**
 * Public Routes
 */
Route::group(['middleware' => ['throttle:60,1']], function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
    Route::get('/go/{product}', RedirectController::class)->name('redirect');
});

/**
 * Authentication Routes
 */
Route::middleware('guest')->group(function () {
    // Route::get('register', [RegisteredUserController::class, 'create'])->name('register');
    // Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])->name('password.request');
    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])->name('password.reset');
    Route::post('reset-password', [NewPasswordController::class, 'store'])->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', VerifyEmailController::class)->name('verification.notice'); // Usually VerifyEmailController invokes a view, wait. My controller uses __invoke logic, need to check.
    // Wait, the standard VerifyEmailController usually handles the LINK click.
    // I need a generic route for showing the notice if I didn't create a controller for SHOWING the notice.
    // Standard Laravel defines:
    // GET /verify-email -> verification.notice (view)
    // GET /verify-email/{id}/{hash} -> verification.verify
    // POST /email/verification-notification -> verification.send

    // Let's fix this in the routes file directly if controller is missing "show" method.
    // My VerifyEmailController was just __invoke handling the link.
    // I need a route for the view.

    Route::get('verify-email', function () {
        return view('auth.verify-email');
    })->name('verification.notice');
    
    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});


/**
 * Admin Routes
 */
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/metrics/reset', [\App\Http\Controllers\Admin\MetricsController::class, 'reset'])->name('metrics.reset');
    Route::resource('products', AdminProductController::class);
    Route::resource('categories', CategoryController::class);
});
