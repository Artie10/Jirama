<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
{
    // Validation des identifiants
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Authentification du personnel
    if (!Auth::guard('employe')->attempt($credentials)) {
        return back()
            ->withErrors([
                'email' => 'Identifiants incorrects.',
            ])
            ->onlyInput('email');
    }

    // Régénérer l'identifiant de session
    $request->session()->regenerate();

    $employe = Auth::guard('employe')->user();

    // Vérifier si le compte est actif
    if (!$employe->actif) {

        Auth::guard('employe')->logout();

        return back()->withErrors([
            'email' => 'Votre compte est désactivé.',
        ]);
    }

    // Identifier la page depuis laquelle l'employé se connecte
    $contexte = $request->input('contexte');

    // Connexion depuis Technicien terrain
    if ($contexte === 'technicien') {

        if ($employe->role !== 'MAITRE_MESURE') {

            Auth::guard('employe')->logout();

            return back()
                ->withErrors([
                    'email' => 'Vous n’êtes pas maître mesure.',
                ])
                ->onlyInput('email');
        }

        return redirect()->route('technicien');
    }

    // Connexion depuis l'espace Admin
    if ($employe->role === 'ADMIN_TRAITEMENT') {
        return redirect()->route('admin.dashboard');
    }

    if ($employe->role === 'MAITRE_MESURE') {
        return redirect()->route('technicien');
    }

    // Rôle non autorisé
    Auth::guard('employe')->logout();

    return back()->withErrors([
        'email' => 'Votre rôle ne permet pas d’accéder à cette application.',
    ]);
}
}
