<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\HistoriesController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\User\EventController as UserEventController;
use App\Http\Controllers\User\OrderController;

//homepage
use App\Models\Kategori;
use App\Models\Event;

// jangan lupa import controller
use App\Http\Controllers\User\HomeController;

Route::get('/', [HomeController::class, 'index'])->name('home');

// route untuk melihat detail event
Route::get('/events/{event}', [UserEventController::class, 'show'])->name('events.show');

//order event
Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');
Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // manajemen kategori
        Route::resource('categories', CategoryController::class);

        // manajemen event
        Route::resource('events', EventController::class);

        // manajemen tiket
        Route::resource('tickets', TiketController::class);

        // manajemen histori pemesanan
        Route::get('/histories', [HistoriesController::class, 'index'])->name('histories.index');
        Route::get('/histories/{id}', [HistoriesController::class, 'show'])->name('histories.show');
    });
});

require __DIR__ . '/auth.php';
