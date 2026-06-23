<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\QuoteController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/packages', [PackageController::class, 'index'])->name('packages.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');
Route::get('/quote', [QuoteController::class, 'show'])->name('quote.show');
Route::post('/quote', [QuoteController::class, 'store'])->name('quote.store');

// Booking routes
Route::get('/book/{package:slug}', [BookingController::class, 'show'])->name('booking.show');
Route::post('/book', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/confirmation/{reference}', [BookingController::class, 'confirmation'])->name('booking.confirmation');

// Filament CSS workaround for Windows
Route::get('/filament-css/{path}', function ($path) {
    $cssPath = base_path("vendor/filament/filament/dist/{$path}");
    if (!file_exists($cssPath)) {
        abort(404);
    }
    return response()->file($cssPath, ['Content-Type' => 'text/css']);
})->where('path', '.*');
