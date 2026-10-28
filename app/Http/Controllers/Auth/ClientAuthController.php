<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class ClientAuthController extends Controller
{
    //aUTHENTIFICATION CLIENT
        public function login(Request $request)
    {
        // 1. Vérifier les champs reçus
        $credentials = $request->validate([
            'reference' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);

        // 2. Rechercher le dossier par numéro ou par e-mail
        $dossier = Dossier::where('NumDossier', $credentials['reference'])
            ->orWhere('Mail', $credentials['reference'])
            ->first();

        // 3. Vérifier le dossier et le mot de passe
        if (
            !$dossier ||
            !Hash::check($credentials['password'], $dossier->password)
        ) {
            return back()
                ->withInput($request->only('reference'))
                ->with('error', 'Référence, courriel ou mot de passe incorrect.');
        }

        // 4. Ouvrir la session du client
        Auth::guard('client')->login($dossier);

        // 5. Renouveler l'identifiant de session
        $request->session()->regenerate();

        // 6. Rediriger vers le tableau de bord client
        return redirect()->route('client.dashboard');
    }

    public function logout(Request $request)
    {
        Auth::guard('client')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('TraitementDossierA');
    }


}
