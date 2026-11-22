<?php

namespace App\Http\Controllers;

use App\Models\Mesure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
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
        'longueur' => ['required', 'numeric', 'gt:0', 'max:999999.99'],
        'autorisation' => ['required', 'in:Oui,Non'],
        'latitude' => ['nullable', 'numeric', 'between:-90,90'],
        'longitude' => ['nullable', 'numeric', 'between:-180,180'],
        'adresse_localisation' => ['nullable', 'string', 'max:10000'],
        'plan_parcours_image' => ['nullable', 'string'],
    ]);

    // 4. Vérifier les coordonnées
    if (
        ($request->filled('latitude') && !$request->filled('longitude'))
        || (!$request->filled('latitude') && $request->filled('longitude'))
    ) {
        return back()
            ->withErrors([
                'latitude' => 'La latitude et la longitude doivent être renseignées ensemble.'
            ])
            ->withInput();
    }

    // 5. Récupérer ou créer la mesure
    $mesure = Mesure::firstOrNew([
        'NumDossier' => $client->NumDossier,
    ]);

    // 6. Générer le numéro si nouvelle mesure
    if (!$mesure->exists) {
        do {
            $numMesure = 'MES-' . now()->format('Ymd') . '-'
                . Str::upper(Str::random(6));

        } while (Mesure::where('NumMesure', $numMesure)->exists());

        $mesure->NumMesure = $numMesure;
    }

    // 7. Enregistrer les informations de mesure
    $mesure->autorisation = $donnees['autorisation'];
    $mesure->date = now()->toDateString();
    $mesure->longueur = $donnees['longueur'];
    $mesure->latitude = $donnees['latitude'] ?? null;
    $mesure->longitude = $donnees['longitude'] ?? null;
    $mesure->adresse_localisation = $donnees['adresse_localisation'] ?? null;

    $mesure->save();

    // 8. Enregistrer le plan dessiné comme image PNG
    $imagePlan = $request->input('plan_parcours_image');

    if ($imagePlan) {

        if (!preg_match('/^data:image\/png;base64,([A-Za-z0-9+\/=]+)$/', $imagePlan, $matches)) {
            return back()->withErrors([
                'plan_parcours_image' => 'Le format du plan est invalide.'
            ])->withInput();
        }

        $contenuImage = base64_decode($matches[1], true);

        if (
            $contenuImage === false
            || strlen($contenuImage) > 5 * 1024 * 1024
            || @getimagesizefromstring($contenuImage) === false
        ) {
            return back()->withErrors([
                'plan_parcours_image' => 'Le plan est invalide ou dépasse 5 Mo.'
            ])->withInput();
        }

        $nomFichier = 'plans/' . $mesure->NumMesure . '_' . Str::random(8) . '.png';

        Storage::disk('public')->put($nomFichier, $contenuImage);
    }

    // 9. Retourner sur l'étude terrain
    return redirect()
        ->route('technicien')
        ->with('success', 'Étude terrain enregistrée avec succès.');
}

}
