<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Home stranica (welcome view)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard stranica za autentifikovane korisnike
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grupa ruta za autentifikovane korisnike
Route::middleware('auth')->group(function () {

    // -----------------------------------------
    // Profil korisnika (prikaz, izmena, brisanje)
    // -----------------------------------------
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit'); // Prikaz forme za izmenu profila
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Ažuriranje profila
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Brisanje profila

    // -----------------------------------------
    // Oglasi - pretraga i prikaz
    // -----------------------------------------
    Route::get('/my-ads', [AdController::class, 'myAds'])->name('my.ads'); // Prikaz oglasa koje je korisnik postavio
    Route::get('/ads', [AdController::class, 'index'])->name('ads.index'); // Prikaz svih oglasa

    // -----------------------------------------
    // Poruke
    // -----------------------------------------
    Route::get('/ads/{ad}/message', [MessageController::class, 'create'])->name('messages.create'); // Prikaz forme za slanje poruke vlasniku oglasa
    Route::post('/ads/{ad}/message', [MessageController::class, 'store'])->name('messages.store'); // Slanje poruke

    // -----------------------------------------
    // Upravljanje oglasima - CRUD operacije
    // -----------------------------------------
    Route::resource('ads', AdController::class); // Svi standardni CRUD (kreiranje, prikaz, izmena, brisanje oglasa)
    Route::get('ads/{ad}/edit', [AdController::class, 'edit'])->name('ads.edit'); // Prikaz forme za izmenu oglasa
    Route::put('ads/{ad}', [AdController::class, 'update'])->name('ads.update'); // Ažuriranje oglasa
    Route::delete('/ads/{ad}/images/{image}', [AdController::class, 'destroyImage'])->name('ads.image.destroy'); // Brisanje slike iz oglasa

    // -----------------------------------------
    // Upravljanje kategorijama i lokacijama (CRUD)
    // -----------------------------------------
    Route::resource('categories', CategoryController::class); // Upravljanje kategorijama
    Route::resource('locations', LocationController::class); // Upravljanje lokacijama

    // -----------------------------------------
    // Poruke vezane za kupovinu/prodaju oglasa
    // -----------------------------------------
    Route::get('/ads/{ad}/chat', [MessageController::class, 'showChat'])->name('messages.chat'); // Prikaz četa za oglas
    Route::get('/messages/sales', [MessageController::class, 'salesMessages'])->name('messages.sales'); // Prikaz poruka koje je korisnik dobio kao prodavac
    Route::get('/messages/purchases', [MessageController::class, 'purchaseMessages'])->name('messages.purchases'); // Prikaz poruka koje je korisnik poslao kao kupac
});

// -----------------------------------------
// Autentifikacija i registracija korisnika
// -----------------------------------------
require __DIR__.'/auth.php';

