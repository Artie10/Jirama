<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ClientAuthController;

// Tableau de bord
Route::get('/dashboard', function () {
    return view('welcome');
})->name('dashboard');

// Suivi
Route::get('/suivi', function () {
    return view('welcome');
})->name('suivi');

// Nouvelle demande
Route::get('/nouvelle-demande', function () {
    return view('welcome');
})->name('demande.create');

// Espace technicien
Route::get('/technicien', function () {
    return view('welcome');
})->name('technicien');

// Devis et dossiers
Route::get('/devis', function () {
    return view('welcome');
})->name('devis');

//CONNIXION
Route::post('/client/login', [ClientAuthController::class, 'login'])
    ->name('client.login.submit');
Route::post('/logout', function () {

    Auth::logout();

    request()->session()->invalidate();
    request()->session()->regenerateToken();


// DECONECTION
})->name('logout');
Route::view('/','LoginClient')->name('TraitementDossierA');


Route::fallback(function(){
    return 'Une erreur est survenue';
});

Route::get('/client/dashboard', function () {
    return 'Bienvenue dans votre espace client !';
})->middleware('auth:client')->name('client.dashboard');
