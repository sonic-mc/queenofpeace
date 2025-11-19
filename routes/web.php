<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogsController;
use App\Http\Controllers\Admin\GallerysController;
use App\Http\Controllers\Admin\DonationManagementController;


/* Web Routes */

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/services', [ServicesController::class, 'index'])->name('services');
Route::get('/team', [TeamController::class, 'index'])->name('team');
Route::get('/faq', [FaqController::class, 'index'])->name('faq');
Route::get('/events', [EventsController::class, 'index'])->name('events');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
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

// Public donation routes
Route::get('/donate', [DonationController::class, 'index'])->name('donate.index');
Route::post('/donate/process', [DonationController::class, 'process'])->name('donate.process');
Route::get('/donate/thank-you', [DonationController::class, 'thankYou'])->name('donate.thankyou');
Route::post('/donate/callback', [DonationController::class, 'callback'])->name('donate.callback');
Route::get('/donate/receipt/{id}', [DonationController::class, 'receipt'])->name('donate.receipt');

// Admin routes (protected by auth middleware)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/donations', [DonationController::class, 'adminIndex'])->name('admin.donations.index');
    Route::post('/donations/{id}/verify', [DonationController::class, 'verifyPayment'])->name('admin.donations.verify');
    Route::get('/donations/export', [DonationController::class, 'export'])->name('admin.donations.export');
    Route::post('/donations/{id}/cancel-recurring', [DonationController::class, 'cancelRecurring'])->name('admin.donations.cancel-recurring');
    Route::get('donors/{id}', [DonationManagementController::class, 'showDonor'])->name('donors.show');
    Route::get('donors/export', [DonationManagementController::class, 'exportDonors'])->name('donors.export');
});




// Admin Authentication Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Protected Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    
    // Profile
    Route::get('profile', [AuthController::class, 'profile'])->name('profile');
    Route::post('profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    
    // Blog Management
    Route::resource('blog', BlogsController::class);
    
    // Gallery Management
    Route::resource('gallery', GallerysController::class);
    Route::post('gallery/bulk-delete', [GallerysController::class, 'bulkDelete'])->name('gallery.bulk-delete');
    
    // Donation Management
    Route::get('donations', [DonationManagementController::class, 'index'])->name('donations.index');
    Route::get('donations/{id}', [DonationManagementController::class, 'show'])->name('donations.show');
    Route::post('donations/{id}/verify', [DonationManagementController::class, 'verify'])->name('donations.verify');
    Route::get('donations/export', [DonationManagementController::class, 'export'])->name('donations.export');
    Route::get('donors', [DonationManagementController::class, 'donors'])->name('donors.index');
});