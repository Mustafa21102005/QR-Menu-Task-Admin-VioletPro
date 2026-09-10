<?php

use App\Http\Controllers\{CategoryController, DashboardController, HomeController, ItemController};
use Illuminate\Support\Facades\{Auth, Route};

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'update', 'destroy']);

    Route::resource('items', ItemController::class);
});

Auth::routes([
    'register' => false,
    'verify'   => false,
]);
