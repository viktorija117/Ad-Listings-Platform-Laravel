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

// Grupa ruta za autentifikovane korisnike
Route::middleware('auth')->group(function () {
    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Inbox i poslate poruke
    Route::get('/inbox', [MessageController::class, 'inbox'])->name('messages.inbox');
    Route::get('/sent', [MessageController::class, 'sent'])->name('messages.sent');

    // Pretraga oglasa
    Route::get('ads/search', [AdController::class, 'search'])->name('ads.search');

    // Prikaz i upravljanje sopstvenim oglasima
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my.ads');

    // Kreiranje i slanje poruka (vezano za oglase)
    Route::get('/ads/{ad}/message', [MessageController::class, 'create'])->name('messages.create');
    Route::post('/ads/{ad}/message', [MessageController::class, 'store'])->name('messages.store');

    // Upravljanje oglasima - dostupno svim korisnicima
    Route::resource('ads', AdController::class);
    Route::delete('/ads/{ad}/images/{image}', [AdController::class, 'destroyImage'])->name('ads.image.destroy');
    Route::resource('categories', CategoryController::class);
    Route::resource('locations', LocationController::class);
    Route::get('ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit'); // za prikaz forme za editovanje
    Route::put('ads/{ad}', [AdController::class, 'update'])->name('ads.update'); // za ažuriranje oglasa
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index');
    Route::get('/ads/{ad}/chat', [MessageController::class, 'showChat'])->name('messages.chat');
// Prodaja - prikaz poruka za oglase koje je korisnik postavio
    Route::get('/messages/sales', [MessageController::class, 'salesMessages'])->name('messages.sales');

// Kupovina - prikaz poruka koje je korisnik poslao vlasnicima drugih oglasa
    Route::get('/messages/purchases', [MessageController::class, 'purchaseMessages'])->name('messages.purchases');

});

// Autentifikacija i registracija
require __DIR__.'/auth.php';
