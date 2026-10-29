<?php

namespace App\Http\Controllers;

use App\Models\Dossier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class DossierController extends Controller
{
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
    }
}
