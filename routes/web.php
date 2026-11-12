
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EtudeTerrainController;


// ==================================================
// TABLEAU DE BORD CLIENT
// ==================================================

Route::get('/client/dashboard', function (Request $request) {

    $client = $request->user('client');

    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    // Récupérer la dernière mesure du client
    $mesure = $client->mesures()->latest()->first();

    return response()
        ->view('components.client.dashboard', compact('client', 'mesure'))
        ->header('Cache-Control', 'no-cache, no-store, must-revalidate, max-age=0')
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');

})->middleware('auth:client')->name('client.dashboard');


// ==================================================
// SUIVI DU DOSSIER
// ==================================================

Route::get('/suivi', function (Request $request) {

    $client = $request->user('client');

    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    $mesure = $client->mesures()->latest()->first();

    return view('components.client.dashboard', compact('client', 'mesure'));

})->middleware('auth:client')->name('suivi');


// ==================================================
// NOUVELLE DEMANDE
// ==================================================

Route::get('/nouvelle-demande', [
    DossierController::class,
    'create',
])->middleware('auth:client')->name('demande.create');

Route::post('/nouvelle-demande', [
    DossierController::class,
    'store',
])->middleware('auth:client')->name('demande.store');


// ==================================================
// MES DEVIS ET DOSSIERS
// ==================================================

Route::get('/devis', function (Request $request) {

    $client = $request->user('client');

    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    $mesure = $client->mesures()->latest()->first();

    return view('components.client.dashboard', compact('client', 'mesure'));

})->middleware('auth:client')->name('devis');


// ==================================================
// ESPACE TECHNICIEN TERRAIN
// ==================================================

Route::get('/technicien', function (Request $request) {

    // Vérifier le client connecté
    if (!Auth::guard('client')->check()) {
        return redirect()->route('LoginClient');
    }

    $client = Auth::guard('client')->user();

    // Vérifier l'employé connecté
    $employe = Auth::guard('employe')->user();

    if ($employe && $employe->role !== 'MAITRE_MESURE') {
        abort(403, 'Accès réservé au maître mesure.');
    }

    $mesure = $client->mesures()->latest()->first();

    return view('components.client.dashboard', compact('client', 'mesure'));

})->middleware('auth:client')->name('technicien');


// ==================================================
// CONNEXION CLIENT
// ==================================================

Route::post('/client/login', [ClientAuthController::class, 'login'])
    ->name('client.login.submit');


// ==================================================
// DECONNEXION CLIENT
// ==================================================

Route::post('/logout', function (Request $request) {

    Auth::guard('client')->logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    return redirect()->route('LoginClient');

})->name('logout');


// ==================================================
// PAGE DE CONNEXION
// ==================================================

Route::view('/', 'LoginClient')->name('LoginClient');


// ==================================================
// VERIFICATION EMAIL
// ==================================================

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


// ==================================================
// CONNEXION ADMIN
// ==================================================

Route::view('/pageLoginAdmin', 'pageLoginAdmin')
    ->middleware('guest:employe')
    ->name('admin.login');


// TRAITEMENT DE LA CONNEXION ADMIN

Route::post('/admin/login', [AdminAuthController::class, 'login'])
    ->middleware('guest:employe')
    ->name('admin.login.submit');


// ==================================================
// TABLEAU DE BORD ADMIN
// ==================================================

Route::get('/tableauxDeBordAdmin', [DossierController::class, 'index'])
    ->middleware('auth:employe')
    ->name('admin.dashboard');


// GESTION DES DOSSIERS

Route::get('/admin/dossiers', [DossierController::class, 'index'])
    ->middleware('auth:employe')
    ->name('admin.dossiers.index');


// ==================================================
// ENREGISTREMENT DE L'ETUDE TERRAIN
// ==================================================

Route::post('/technicien/etude', [EtudeTerrainController::class, 'store'])
    ->middleware('auth:employe')
    ->name('etude.store');
