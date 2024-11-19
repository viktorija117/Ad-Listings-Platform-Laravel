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

    // Profil korisnika (prikaz, izmena, brisanje)
    Route::controller(ProfileController::class)->prefix('profile')->group(function () {
        Route::get( 'edit')->name('profile.edit'); // Prikaz forme za izmenu profila
        Route::patch('update')->name('profile.update'); // Ažuriranje profila
        Route::delete( 'destroy')->name('profile.destroy'); // Brisanje profila
    });

    // Oglasi - pretraga i prikaz
    Route::controller(AdController::class)->group(function () {
        Route::get('/my-ads', 'myAds')->name('my.ads'); // Prikaz oglasa koje je korisnik postavio
        Route::get('/ads', 'index')->name('ads.index'); // Prikaz svih oglasa
    });

    // Upravljanje oglasima - CRUD operacije
    Route::resource('ads', AdController::class); // Svi standardni CRUD (kreiranje, prikaz, izmena, brisanje oglasa)

    // Upravljanje kategorijama i lokacijama (CRUD)
    Route::resource('categories', CategoryController::class); // Upravljanje kategorijama
    Route::resource('locations', LocationController::class); // Upravljanje lokacijama

    // Poruke vezane za kupovinu/prodaju oglasa
    Route::middleware('auth')->group(function () {
        Route::get('/messages', [MessageController::class, 'index'])->name('messages.index'); // Prikaz liste četova gde je korisnik učesnik
        Route::get('/ads/{ad}/chat/{partnerId}', [MessageController::class, 'showChat'])->name('messages.chat'); // Prikaz pojedinačnog četa (jedan oglas + jedan sagovornik)
        Route::post('/ads/{ad}/message', [MessageController::class, 'store'])->name('messages.store'); // Slanje nove poruke
    });
});

// Autentifikacija i registracija korisnika
require __DIR__.'/auth.php';

