<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Models\JournalEvenement;
class DossierController extends Controller
{



/**
 * Modifier un document du dossier existant du client.
 */


    /**
 * Afficher le formulaire de nouvelle demande
 */


public function create()
{
    return view('components.client.DemandeRaccordement');
}
    /**
     * Enregistrer une demande de raccordement.
     */
    public function store(Request $request)
    {
        // 1. Validation des informations et des documents
        $validated = $request->validate([
            'statut_demandeur' => [
                'required',
                Rule::in(['proprietaire', 'mandataire']),
            ],

            'nom' => ['required', 'string', 'max:100'],
            'prenom' => ['required', 'string', 'max:150'],

            'cin' => [
                'required',
                'regex:/^[0-9]{12}$/',
                'unique:dossiers,Cin',
            ],

            'telephone' => ['required', 'string', 'max:20'],

            'email' => [
                'required',
                'email',
                'max:191',
                'unique:dossiers,Mail',
            ],

            'password' => ['required', 'string', 'min:8', 'confirmed'],

            'photo_identite' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

            'justificatif_domicile' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png,webp',
                'max:5120',
            ],

            'cin_document' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

            'demande_signee' => [
                'required',
                'file',
                'mimes:pdf,jpg,jpeg,png',
                'max:5120',
            ],

            'certification' => ['required', 'accepted'],
        ], [
            'cin.regex' => 'Le CIN doit contenir exactement 12 chiffres.',
            'cin.unique' => 'Ce CIN est déjà associé à un dossier.',
            'email.unique' => 'Cette adresse e-mail est déjà utilisée.',
            'password.confirmed' => 'Les deux mots de passe ne correspondent pas.',
            'justificatif_domicile.required' => 'Le justificatif de domicile est obligatoire.',
            'cin_document.required' => 'La copie de la CIN est obligatoire.',
            'demande_signee.required' => 'La demande signée est obligatoire.',
            'certification.accepted' => 'Vous devez accepter la déclaration sur l’honneur.',
        ]);

        // 2. Stocker les documents
        $fichiers = [];

        try {
            $fichiers['residence_img'] = $request
                ->file('justificatif_domicile')
                ->store('residence', 'public');

            $fichiers['Dmd_img'] = $request
                ->file('demande_signee')
                ->store('Demande', 'public');

            $fichiers['cin_document'] = $request
                ->file('cin_document')
                ->store('dossiers/cin', 'public');

            if ($request->hasFile('photo_identite')) {
                $fichiers['photo_identite'] = $request
                    ->file('photo_identite')
                    ->store('dossiers/photos', 'public');
            }

            // 3. Créer le dossier dans la base
            $dossier = DB::transaction(function () use (
                $validated,
                $fichiers
            ) {
                do {
                    $numero = 'DOS-ANT-'
                        . now()->format('Ymd')
                        . '-'
                        . Str::upper(Str::random(6));
                } while (
                    Dossier::where('NumDossier', $numero)->exists()
                );

                return Dossier::create([
                    'NumDossier' => $numero,

                    'Nom' => trim(
                        $validated['nom'] . ' ' . $validated['prenom']
                    ),

                    'Mail' => $validated['email'],
                    'Cin' => $validated['cin'],
                    'telephone' => $validated['telephone'],
                    'password' => $validated['password'],

                    'statut_demandeur' => $validated['statut_demandeur'],

                    'residence_img' => $fichiers['residence_img'],
                    'Dmd_img' => $fichiers['Dmd_img'],
                    'cin_document' => $fichiers['cin_document'],

                    'photo_identite' => $fichiers['photo_identite'] ?? null,

                    // Aucun document d'autorisation distinct
                    // n'est demandé par le formulaire actuel.
                    'autorisation_img' => null,

                    'statut' => 'En attente',
                ]);
            });
        } catch (\Throwable $e) {
            // Nettoyer les fichiers si leur enregistrement échoue.
            foreach ($fichiers as $chemin) {
                Storage::disk('public')->delete($chemin);
            }

            throw $e;
        }

        // 4. Connecter le demandeur pour la vérification de son e-mail
        Auth::guard('client')->login($dossier);
        $request->session()->regenerate();

        // 5. Envoyer le lien de vérification
        $dossier->sendEmailVerificationNotification();

        return redirect()
            ->route('verification.notice')
            ->with(
                'success',
                'Votre demande a été enregistrée. Vérifiez votre boîte e-mail pour confirmer votre adresse.'
            );


        $dossier = Auth::guard('client')->user();

            $mesures = $dossier->mesures;

                return view('components.client.dashboard', compact('dossier', 'mesures'));
    }
//MODIFIER DOCUMENT
public function modifierDocument(Request $request)
{
    // 1. Récupérer le client connecté
    $client = Auth::guard('client')->user();

    abort_unless($client, 403);

    // 2. Vérifier son adresse e-mail
    if (!$client->hasVerifiedEmail()) {
        return redirect()->route('verification.notice');
    }

    // 3. Valider le document envoyé
    $validated = $request->validate([
        'type_document' => [
            'required',
            Rule::in([
                'autorisation_passage',
                'photos_terrain',
                'piece_identite',
                'justificatif_domicile',
            ]),
        ],

        'fichier' => [
            'required',
            'file',
            'mimes:pdf,jpg,jpeg,png',
            'max:15360',
        ],
    ]);

    // 4. Associer chaque type à sa colonne existante
    $colonnes = [
        'autorisation_passage' => 'autorisation_img',
        'photos_terrain' => 'photos_terrain',
        'piece_identite' => 'cin_document',
        'justificatif_domicile' => 'residence_img',
    ];

    $colonne = $colonnes[$validated['type_document']];

    // 5. Conserver le chemin de l'ancien document
    $ancienFichier = $client->{$colonne};

    // 6. Stocker le nouveau document
    $chemin = $request->file('fichier')->store(
        'dossiers/' . $client->NumDossier,
        'public'
    );

    try {
        DB::transaction(function () use (
            $client,
            $colonne,
            $chemin,
            $validated
        ) {
            // Remplacer le document dans le dossier existant
            $client->{$colonne} = $chemin;
            $client->save();

            // Ajouter une trace dans le journal
            JournalEvenement::create([
                'NumDossier' => $client->NumDossier,
                'type' => 'validation',
                'titre' => 'Modification d’un document du dossier',
                'description' => 'Le client a déposé un nouveau document (' .
                    $validated['type_document'] .
                    '). Ce document est en attente de vérification.',
                'acteur' => $client->Nom,
            ]);
        });
    } catch (\Throwable $e) {
        Storage::disk('public')->delete($chemin);

        throw $e;
    }

    // 7. Supprimer l'ancien fichier après la mise à jour réussie
    if ($ancienFichier && $ancienFichier !== $chemin) {
        Storage::disk('public')->delete($ancienFichier);
    }

    return redirect()
        ->route('devis')
        ->with('success', 'Votre document a été remplacé avec succès.');
}
    //TRAITEMENT DOSSIER ADMIN

      public function index(Request $request)
    {
        $query = dossier::query();

        // Recherche par référence, nom ou commune
        if ($request->filled('q')) {
            $recherche = $request->input('q');

            $query->where(function ($q) use ($recherche) {
                $q->where('NumDossier', 'like', "%{$recherche}%")
                    ->orWhere('Nom', 'like', "%{$recherche}%")
                    ->orWhere('Mail', 'like', "%{$recherche}%");
            });
        }

        // Filtrage selon le statut
        if ($request->filled('statut')) {
            $query->where('statut', $request->input('statut'));
        }

        $dossiers = $query
            ->orderBy('created_at', 'asc')
            ->paginate(10)
            ->withQueryString();

        $selectedDossier = $dossiers->first();

        $waitingCount = dossier::count();

        $urgentCount = dossier::where('statut', 'urgent')->count();

        return view('tableauxDeBordAdmin', [
            'dossiers' => $dossiers,
            'selectedDossier' => $selectedDossier,
            'userName' => 'Administrateur',
            'userRole' => 'Pôle Raccordement',
            'waitingCount' => $waitingCount,
            'urgentCount' => $urgentCount,
            'averageDelay' => 'Non calculé',
        ]);
    }
}
