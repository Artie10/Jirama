<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\ClientAuthController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EtudeTerrainController;
// Tableau de bord
// Tableau de bord du client
Route::get('/client/dashboard', function (Request $request) {

    $client = $request->user('client');

    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    return view('components.client.dashboard');

})->middleware('auth:client')->name('client.dashboard');

// SUIVI DU DOSSIER
Route::get('/suivi', function () {

    if (!Auth::guard('client')->check()) {
        return redirect()->route('LoginClient');
    }

    $client = Auth::guard('client')->user();

    return view('components.client.dashboard', compact('client'));

})->name('suivi');


// NOUVELLE DEMANDE
// NOUVELLE DEMANDE
Route::get('/nouvelle-demande', function () {

    if (!Auth::guard('client')->check()) {
        return redirect()->route('LoginClient');
    }

    $client = Auth::guard('client')->user();

    return view('components.client.dashboard', compact('client'));

})->name('demande.create');

// MES DEVIS ET DOSSIERS
Route::get('/devis', function () {

    if (!Auth::guard('client')->check()) {
        return redirect()->route('LoginClient');
    }

    $client = Auth::guard('client')->user();

    return view('components.client.dashboard', compact('client'));

})->name('devis');







// ESPACE TECHNICIEN TERRAIN
Route::get('/technicien', function () {

    // Vérifier que le client est connecté
    if (!Auth::guard('client')->check()) {
        return redirect()->route('LoginClient');
    }

    // Récupérer le client connecté
    $client = Auth::guard('client')->user();

    // Vérifier si un employé est connecté
    $employe = Auth::guard('employe')->user();

    // Si un employé est connecté, vérifier son rôle
    if ($employe && $employe->role !== 'MAITRE_MESURE') {
        abort(403, 'Accès réservé au maître mesure.');
    }

    // Afficher la page principale du client
    return view('components.client.dashboard', compact('client'));

})->name('technicien');




//CONNIXION
Route::post('/client/login', [ClientAuthController::class, 'login'])
    ->name('client.login.submit');

//DECONECTION
Route::post('/logout', function (Request $request) {

    Auth::guard('client')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('LoginClient');

})->name('logout');

Route::view('/','LoginClient')->name('LoginClient');



//CHARGEMENT Dashboard et chargement mesure
Route::get('/client/dashboard', function (Request $request) {

    $client = $request->user('client');

    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    // Charger les mesures associées au dossier du client
    $client->load('mesures');

    return response()
        ->view('components.client.dashboard', compact('client'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');

})->middleware('auth:client')->name('client.dashboard');

//VERIFICATION EMAIL
// Page d'information pour les e-mails à vérifier
Route::get('/client/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth:client')->name('verification.notice');

// Lien signé reçu par e-mail
Route::get('/client/email/verify/{id}/{hash}', function (
    EmailVerificationRequest $request
) {
    if ($request->user('client')->hasVerifiedEmail()) {
        return redirect()->route('client.dashboard');
    }

    $request->user('client')->markEmailAsVerified();

    return redirect()->route('client.dashboard')
        ->with('success', 'Votre adresse e-mail a été vérifiée.');
})->middleware(['auth:client', 'signed', 'throttle:6,1'])
  ->name('verification.verify');

// Renvoyer l'e-mail de vérification
Route::post('/client/email/verification-notification', function (Request $request) {
    $user = $request->user('client');

    if ($user->hasVerifiedEmail()) {
        return redirect()->route('client.dashboard');
    }

    $user->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');
})->middleware(['auth:client', 'throttle:6,1'])
  ->name('verification.send');


  //ROUTE NOUVELLE DEMANDE



Route::get('/nouvelle-demande', [
    DossierController::class,
    'create',
])->name('demande.create');

Route::post('/nouvelle-demande', [
    DossierController::class,
    'store',
])->name('demande.store');

//Affichage demande
Route::get('/nouvelle-demande', function () {
    return view('components.client.DemandeRaccordement', [
        'action' => route('demande.store'),
        'nom' => old('nom', ''),
        'prenom' => old('prenom', ''),
        'cin' => old('cin', ''),
        'telephone' => old('telephone', ''),
        'email' => old('email', ''),
    ]);
})->name('demande.create');

// APRES CONNEX PAGE ADMIN

Route::view('/pageLoginAdmin', 'pageLoginAdmin')
    ->middleware('guest:employe')
    ->name('admin.login');

// TRAITEMENT DE LA CONNEXION
Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('guest:employe')
    ->name('admin.login.submit');

// TABLEAU DE BORD ADMIN
Route::get('/tableauxDeBordAdmin', [DossierController::class, 'index'])
    ->middleware('auth:employe')
    ->name('admin.dashboard');

// GESTION DES DOSSIERS
Route::get('/admin/dossiers', [DossierController::class, 'index'])
    ->middleware('auth:employe')
    ->name('admin.dossiers.index');

//Gestion mesures
// ENREGISTREMENT DE L'ETUDE TERRAIN
Route::post('/technicien/etude', [EtudeTerrainController::class, 'store'])
    ->name('etude.store');
