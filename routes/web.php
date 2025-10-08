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
    
    // Settings Routes
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\SettingsController::class, 'index'])->name('index');
        
        // Language Management
        Route::get('/language', [\App\Http\Controllers\Admin\SettingsController::class, 'language'])->name('language');
        Route::post('/language', [\App\Http\Controllers\Admin\SettingsController::class, 'storeLanguage'])->name('language.store');
        Route::put('/language/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateLanguage'])->name('language.update');
        Route::delete('/language/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteLanguage'])->name('language.delete');
        
        // Caste Management
        Route::get('/caste', [\App\Http\Controllers\Admin\SettingsController::class, 'caste'])->name('caste');
        Route::post('/caste', [\App\Http\Controllers\Admin\SettingsController::class, 'storeCaste'])->name('caste.store');
        Route::put('/caste/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateCaste'])->name('caste.update');
        Route::delete('/caste/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteCaste'])->name('caste.delete');
        
        // Highest Education Management
        Route::get('/highest-education', [\App\Http\Controllers\Admin\SettingsController::class, 'highestEducation'])->name('highest-education');
        Route::post('/highest-education', [\App\Http\Controllers\Admin\SettingsController::class, 'storeHighestEducation'])->name('highest-education.store');
        Route::put('/highest-education/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateHighestEducation'])->name('highest-education.update');
        Route::delete('/highest-education/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteHighestEducation'])->name('highest-education.delete');
        
        // Education Details Management
        Route::get('/education-details', [\App\Http\Controllers\Admin\SettingsController::class, 'educationDetails'])->name('education-details');
        Route::post('/education-details', [\App\Http\Controllers\Admin\SettingsController::class, 'storeEducationDetails'])->name('education-details.store');
        Route::put('/education-details/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateEducationDetails'])->name('education-details.update');
        Route::delete('/education-details/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteEducationDetails'])->name('education-details.delete');
        
        // AJAX route for fetching education details by highest qualification
        Route::get('/education-details-by-qualification/{qualificationId}', [\App\Http\Controllers\Admin\SettingsController::class, 'getEducationDetailsByQualification'])->name('education-details.by-qualification');
        
        // Occupation Management
        Route::get('/occupation', [\App\Http\Controllers\Admin\SettingsController::class, 'occupation'])->name('occupation');
        Route::post('/occupation', [\App\Http\Controllers\Admin\SettingsController::class, 'storeOccupation'])->name('occupation.store');
        Route::put('/occupation/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateOccupation'])->name('occupation.update');
        Route::delete('/occupation/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteOccupation'])->name('occupation.delete');
        
        // Country Management
        Route::get('/country', [\App\Http\Controllers\Admin\SettingsController::class, 'country'])->name('country');
        Route::post('/country', [\App\Http\Controllers\Admin\SettingsController::class, 'storeCountry'])->name('country.store');
        Route::put('/country/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateCountry'])->name('country.update');
        Route::delete('/country/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteCountry'])->name('country.delete');
        
        // State Management
        Route::get('/state', [\App\Http\Controllers\Admin\SettingsController::class, 'state'])->name('state');
        Route::post('/state', [\App\Http\Controllers\Admin\SettingsController::class, 'storeState'])->name('state.store');
        Route::put('/state/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateState'])->name('state.update');
        Route::delete('/state/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteState'])->name('state.delete');
        
        // AJAX route for fetching states by country
        Route::get('/states-by-country/{countryId}', [\App\Http\Controllers\Admin\SettingsController::class, 'getStatesByCountry'])->name('states.by-country');
        
        // City Management
        Route::get('/city', [\App\Http\Controllers\Admin\SettingsController::class, 'city'])->name('city');
        Route::post('/city', [\App\Http\Controllers\Admin\SettingsController::class, 'storeCity'])->name('city.store');
        Route::put('/city/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'updateCity'])->name('city.update');
        Route::delete('/city/{id}', [\App\Http\Controllers\Admin\SettingsController::class, 'deleteCity'])->name('city.delete');
        
        // AJAX route for fetching cities by state
        Route::get('/cities-by-state/{stateId}', [\App\Http\Controllers\Admin\SettingsController::class, 'getCitiesByState'])->name('cities.by-state');
    });
});

// --- Dynamic Location Routes ---
Route::post('/get-countries', [PageController::class, 'getCountries'])->name('getCountries');
Route::post('/get-states', [PageController::class, 'getStates'])->name('getStates');
Route::post('/get-cities', [PageController::class, 'getCities'])->name('getCities');

// --- ADMIN PANEL ROUTES ---
Route::get('/get-educations/{id}', [PageController::class, 'getEducations'])->name('get-educations');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('users', AdminUserController::class)->except(['show', 'create', 'store']);
    Route::resource('memberships', MembershipController::class);


