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
});
