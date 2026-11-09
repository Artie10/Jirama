<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
public function login(Request $request)
{
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::guard('employe')->attempt($credentials)) {
        return back()
            ->withErrors([
                'email' => 'Identifiants incorrects.',
            ])
            ->onlyInput('email');
    }

    $request->session()->regenerate();

    $employe = Auth::guard('employe')->user();

    if (!$employe->actif) {
        Auth::guard('employe')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return back()->withErrors([
            'email' => 'Votre compte est désactivé.',
        ]);
    }

    if ($employe->role === 'ADMIN_TRAITEMENT') {
        return redirect()->route('admin.dashboard');
    }

    if ($employe->role === 'MAITRE_MESURE') {
        return redirect()->route('maitre.dashboard');
    }

    Auth::guard('employe')->logout();

    return back()->withErrors([
        'email' => 'Votre rôle ne permet pas d’accéder à cette application.',
    ]);
}
}
