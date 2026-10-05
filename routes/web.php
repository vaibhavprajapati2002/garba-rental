<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookingController;


Route::get('/', [BookingController::class, 'dashboard'])
    ->name('dashboard');



/*
|--------------------------------------------------------------------------
| Booking Routes
|--------------------------------------------------------------------------
*/

// Show Add Booking Form
Route::get('/bookings/create', [BookingController::class, 'create'])
    ->name('bookings.create');
// Search Bookings
Route::get('/bookings/search', [BookingController::class, 'search'])
    ->name('bookings.search');
// Save Booking
Route::post('/bookings', [BookingController::class, 'store'])
    ->name('bookings.store');
// Show all bookings
Route::get('/bookings', [BookingController::class, 'index'])
->name('bookings.index');
// Show Edit Booking Form
Route::get('/bookings/{booking}/edit', [BookingController::class, 'edit'])
    ->name('bookings.edit');

// Update Booking
Route::put('/bookings/{booking}', [BookingController::class, 'update'])
    ->name('bookings.update');

// Delete Booking
Route::delete('/bookings/{booking}', [BookingController::class, 'destroy'])
    ->name('bookings.destroy');


