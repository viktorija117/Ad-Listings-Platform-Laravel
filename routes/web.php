<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');



    // Inbox i poslate poruke
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/sent', [MessageController::class, 'sent'])->name('messages.sent');
});

Route::get('ads/search', [AdController::class, 'search'])->name('ads.search');
Route::post('messages', [MessageController::class, 'store'])->name('messages.store');


Route::get('/my-ads', [AdController::class, 'myAds'])->name('my.ads');
Route::resource('ads', AdController::class);
Route::delete('/ads/{ad}/images/{image}', [AdController::class, 'destroyImage'])->name('ads.image.destroy');




Route::middleware(['auth', 'admin'])->group(function () {
    // Upravljanje kategorijama i lokacijama - samo za admina
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::resource('locations', LocationController::class)->except(['show']);
});

Route::get('/ads/{ad}/message', [MessageController::class, 'create'])->name('messages.create');
Route::post('/ads/{ad}/message', [MessageController::class, 'store'])->name('messages.store');
require __DIR__.'/auth.php';
