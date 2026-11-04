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
        'password' => ['required', 'string'],
    ]);

    $employe = \App\Models\Employe::where('email', $credentials['email'])
        ->where('actif', true)
        ->where('role', 'ADMIN_TRAITEMENT')
        ->first();

    if (
        $employe &&
        Auth::guard('employe')->attempt($credentials)
    ) {
        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    return back()
        ->withErrors([
            'email' => 'Identifiants incorrects ou compte non autorisé.',
        ])
        ->onlyInput('email');
}
}
