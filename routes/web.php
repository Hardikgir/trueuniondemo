<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\MembershipController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Middleware\AdminMiddleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// --- Language Switcher Route ---
Route::get('language/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'hi', 'gu'])) {
        Session::put('locale', $locale);
    }
    
    
    
    return redirect()->back();
})->name('language.switch');


// --- Public & Guest Routes ---
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::get('/membership', [PageController::class, 'membership'])->name('membership');
Route::get('/search', [PageController::class, 'search'])->name('search');

Route::middleware('guest')->group(function () {
    Route::get('/signup', [PageController::class, 'signup'])->name('signup');
    Route::post('/signup', [RegisterController::class, 'store'])->name('signup.store');
    Route::get('/login', [PageController::class, 'login'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('login.store');
});

// --- Google Auth Routes ---
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('google.login');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// --- Authenticated User Routes ---
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/{id}', [PageController::class, 'viewProfile'])->name('profile.view');
    Route::post('/subscribe/{membership}', [SubscriptionController::class, 'subscribe'])->name('subscribe');
});

// --- ADMIN PANEL ROUTES ---
Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['show', 'create', 'store']);
    Route::resource('memberships', MembershipController::class);
});

