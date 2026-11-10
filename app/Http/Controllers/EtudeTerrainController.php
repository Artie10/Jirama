<?php

namespace App\Http\Controllers;

use App\Models\Mesure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class EtudeTerrainController extends Controller
{
    public function store(Request $request)
    {
        // 1. Vérifier le client connecté
        $client = Auth::guard('client')->user();

        abort_unless($client, 401, 'Client non connecté.');

        // 2. Vérifier le maître mesure connecté
        $employe = Auth::guard('employe')->user();

        abort_unless(
            $employe && $employe->role === 'MAITRE_MESURE',
            403,
            'Accès réservé au maître mesure.'
        );

        // 3. Valider les données reçues
        $donnees = $request->validate([
            'longueur' => [
                'required',
                'numeric',
                'gt:0',
                'max:999999.99'
            ],

            'autorisation' => [
                'required',
                'in:Oui,Non'
            ],

            'latitude' => [
                'nullable',
                'numeric',
                'between:-90,90'
            ],

            'longitude' => [
                'nullable',
                'numeric',
                'between:-180,180'
            ],

            'adresse_localisation' => [
                'nullable',
                'string',
                'max:10000'
            ],
        ]);

        // 4. Vérifier que les deux coordonnées sont fournies ensemble
        if (
            ($request->filled('latitude') && ! $request->filled('longitude'))
            || (! $request->filled('latitude') && $request->filled('longitude'))
        ) {
            return back()
                ->withErrors([
                    'latitude' => 'La latitude et la longitude doivent être renseignées ensemble.'
                ])
                ->withInput();
        }

        // 5. Générer un numéro de mesure unique
        do {
            $numMesure = 'MES-' . now()->format('Ymd') . '-' . Str::upper(Str::random(6));
        } while (Mesure::where('NumMesure', $numMesure)->exists());

        // 6. Enregistrer l'étude
        Mesure::create([
            'NumMesure' => $numMesure,
            'NumDossier' => $client->NumDossier,
            'autorisation' => $donnees['autorisation'],
            'date' => now()->toDateString(),
            'longueur' => $donnees['longueur'],
            'latitude' => $donnees['latitude'] ?? null,
            'longitude' => $donnees['longitude'] ?? null,
            'adresse_localisation' => $donnees['adresse_localisation'] ?? null,
        ]);

        // 7. Retourner sur l'étude terrain
        return redirect()
            ->route('technicien')
            ->with('success', 'Étude terrain enregistrée avec succès.');
    }
}
