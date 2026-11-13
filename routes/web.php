
<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

use App\Http\Controllers\Auth\ClientAuthController;
use App\Http\Controllers\DossierController;
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\EtudeTerrainController;

/*
|--------------------------------------------------------------------------
| FONCTION DE RECUPERATION DES DONNEES CLIENT
|--------------------------------------------------------------------------
| Centralise les données utilisées par le tableau de bord.
*/

$afficherDashboardClient = function (Request $request) {

    // Récupérer le client connecté
    $client = $request->user('client');

    // Sécurité : vérifier que le client existe
    abort_unless($client, 403, 'Accès non autorisé.');

    // Vérifier l'adresse e-mail
    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    // Récupérer la dernière mesure
    $mesure = $client->mesures()
        ->latest()
        ->first();

    // Récupérer le journal des événements
    $evenements = $client->evenements()
        ->latest()
        ->get();

    // Afficher le tableau de bord
    return response()
        ->view('components.client.dashboard', compact(
            'client',
            'mesure',
            'evenements'
        ))
        ->header(
            'Cache-Control',
            'no-cache, no-store, must-revalidate, max-age=0'
        )
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');
};


/*
|--------------------------------------------------------------------------
| TABLEAU DE BORD CLIENT
|--------------------------------------------------------------------------
*/

Route::get('/client/dashboard', $afficherDashboardClient)
    ->middleware('auth:client')
    ->name('client.dashboard');


/*
|--------------------------------------------------------------------------
| SUIVI DU DOSSIER
|--------------------------------------------------------------------------
*/

Route::get('/suivi', $afficherDashboardClient)
    ->middleware('auth:client')
    ->name('suivi');


/*
|--------------------------------------------------------------------------
| NOUVELLE DEMANDE
|--------------------------------------------------------------------------
*/

// Afficher le formulaire
Route::get('/nouvelle-demande', [
    DossierController::class,
    'create',
])
    ->middleware('auth:client')
    ->name('demande.create');

// Enregistrer une nouvelle demande
Route::post('/nouvelle-demande', [
    DossierController::class,
    'store',
])
    ->middleware('auth:client')
    ->name('demande.store');


/*
|--------------------------------------------------------------------------
| MES DEVIS ET DOSSIERS
|--------------------------------------------------------------------------
*/

Route::get('/devis', $afficherDashboardClient)
    ->middleware('auth:client')
    ->name('devis');


/*
|--------------------------------------------------------------------------
| ESPACE TECHNICIEN TERRAIN
|--------------------------------------------------------------------------
|
| Conservation de ton fonctionnement actuel :
| le client doit être connecté pour afficher son dashboard.
|
*/

Route::get('/technicien', function (Request $request) {

    // Vérifier le client connecté
    $client = $request->user('client');

    abort_unless($client, 403, 'Accès non autorisé.');

    // Vérifier l'employé connecté
    $employe = Auth::guard('employe')->user();

    // Vérifier son rôle s'il est connecté
    if ($employe && $employe->role !== 'MAITRE_MESURE') {
        abort(403, 'Accès réservé au maître mesure.');
    }

    // Réutiliser la récupération centralisée
    return app()->call(function () use ($request) {

        return response()->view(
            'components.client.dashboard',
            [
                'client' => $request->user('client'),
                'mesure' => $request->user('client')
                    ->mesures()
                    ->latest()
                    ->first(),
                'evenements' => $request->user('client')
                    ->evenements()
                    ->latest()
                    ->get(),
            ]
        )
        ->header(
            'Cache-Control',
            'no-cache, no-store, must-revalidate, max-age=0'
        )
        ->header('Pragma', 'no-cache')
        ->header('Expires', '0');

    });

})->middleware('auth:client')->name('technicien');


/*
|--------------------------------------------------------------------------
| CONNEXION CLIENT
|--------------------------------------------------------------------------
*/

Route::post('/client/login', [
    ClientAuthController::class,
    'login',
])
    ->middleware('guest:client')
    ->name('client.login.submit');


/*
|--------------------------------------------------------------------------
| DECONNEXION CLIENT
|--------------------------------------------------------------------------
*/

Route::post('/logout', function (Request $request) {

    Auth::guard('client')->logout();

    // Invalider la session
    $request->session()->invalidate();

    // Régénérer le token CSRF
    $request->session()->regenerateToken();

    return redirect()->route('LoginClient');

})->name('logout');


/*
|--------------------------------------------------------------------------
| PAGE DE CONNEXION CLIENT
|--------------------------------------------------------------------------
*/

Route::view('/', 'LoginClient')
    ->middleware('guest:client')
    ->name('LoginClient');


/*
|--------------------------------------------------------------------------
| VERIFICATION DE L'ADRESSE E-MAIL
|--------------------------------------------------------------------------
*/

// Page de vérification
Route::get('/client/email/verify', function () {

    return view('auth.verify-email');

})
    ->middleware('auth:client')
    ->name('verification.notice');


// Lien signé reçu par e-mail
Route::get('/client/email/verify/{id}/{hash}', function (
    EmailVerificationRequest $request
) {

    $client = $request->user('client');

    // Si déjà vérifié
    if ($client->hasVerifiedEmail()) {
        return redirect()->route('client.dashboard');
    }

    // Marquer l'adresse comme vérifiée
    $client->markEmailAsVerified();

    return redirect()
        ->route('client.dashboard')
        ->with('success', 'Votre adresse e-mail a été vérifiée.');

})
    ->middleware([
        'auth:client',
        'signed',
        'throttle:6,1',
    ])
    ->name('verification.verify');


// Renvoyer l'e-mail de vérification
Route::post('/client/email/verification-notification', function (
    Request $request
) {

    $client = $request->user('client');

    if ($client->hasVerifiedEmail()) {
        return redirect()->route('client.dashboard');
    }

    $client->sendEmailVerificationNotification();

    return back()->with('status', 'verification-link-sent');

})
    ->middleware([
        'auth:client',
        'throttle:6,1',
    ])
    ->name('verification.send');


/*
|--------------------------------------------------------------------------
| CONNEXION ADMINISTRATEUR
|--------------------------------------------------------------------------
*/

// Page de connexion admin
Route::view('/pageLoginAdmin', 'pageLoginAdmin')
    ->middleware('guest:employe')
    ->name('admin.login');

// Traitement de la connexion admin
Route::post('/admin/login', [
    AdminAuthController::class,
    'login',
])
    ->middleware('guest:employe')
    ->name('admin.login.submit');


/*
|--------------------------------------------------------------------------
| TABLEAU DE BORD ADMINISTRATEUR
|--------------------------------------------------------------------------
*/

// Tableau de bord
Route::get('/tableauxDeBordAdmin', [
    DossierController::class,
    'index',
])
    ->middleware('auth:employe')
    ->name('admin.dashboard');

// Gestion des dossiers
Route::get('/admin/dossiers', [
    DossierController::class,
    'index',
])
    ->middleware('auth:employe')
    ->name('admin.dossiers.index');


/*
|--------------------------------------------------------------------------
| ENREGISTREMENT DE L'ETUDE TERRAIN
|--------------------------------------------------------------------------
*/

Route::post('/technicien/etude', [
    EtudeTerrainController::class,
    'store',
])
    ->middleware('auth:employe')
    ->name('etude.store');

    // MODIFICATION D'UN DOCUMENT DU DOSSIER EXISTANT

Route::post('/client/dossier/modification', [
    DossierController::class,
    'modifierDocument',
])
    ->middleware('auth:client')
    ->name('dossier.modification');
