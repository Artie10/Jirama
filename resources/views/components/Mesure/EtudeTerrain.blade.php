{{--
    resources/views/components/etude-terrain.blade.php

    Utilisation :
        <x-etude-terrain />
        <x-etude-terrain :longueur="42.5" :servitude="false" action="{{ route('etude.store') }}" />

    Les valeurs par défaut sont fictives. Plus tard, passe les vraies données
    depuis ton contrôleur et définis `action` pour poster vers ton backend.
--}}
@props([
    'action' => route('etude.store'),
    'method' => 'POST',

    // Informations du dossier
    'demandeur' => null,
    'tension' => null,

    // Informations de mesure
    'longueur' => null,
    'cheminement' => null,

    // Informations de localisation
    'latitude' => null,
    'longitude' => null,
    'adresse_localisation' => null,

    // Autorisation
    'autorisation' => null,

    // Informations cadastrales (à connecter ultérieurement)
    'parcelle' => null,
    'proprietaire' => null,

    // Informations complémentaires non encore enregistrées
    'distancePrivee' => null,
    'distancePublique' => null,
    'chute' => null,
    'seuilChute' => 2,
    'prerequisCompletes' => true,
    'horodatage' => null,
])

@once
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/EtudeTerrain.css') }}">
@endonce

@php
    // Le formulaire est maintenant connecté au vrai backend
    $simulation = false;

    $longueurValeur = old('longueur', $longueur ?? '');

    $longueurNum = is_numeric($longueurValeur)
        ? (float) $longueurValeur
        : 0.0;

    $autorisationValeur = old(
        'autorisation',
        $autorisation ?? ''
    );

    $distancePriveeValeur = $distancePrivee ?? 0;
    $distancePubliqueValeur = $distancePublique ?? 0;

    $totalTranchee = max(
        $distancePriveeValeur + $distancePubliqueValeur,
        0.0001
    );

    $pctPublic = round(
        $distancePubliqueValeur / $totalTranchee * 100,
        1
    );

    $pctPrive = round(100 - $pctPublic, 1);

    $seuilLinky = 30;
        // État du bouton selon la réponse du backend
    $messageSucces = session('success');
    $aDesErreurs = $errors->any();

    $classeBouton = $messageSucces ? 'et-bouton--ok' : ($aDesErreurs ? 'et-bouton--erreur' : '');
    $iconeBouton = $messageSucces ? 'check_circle' : ($aDesErreurs ? 'error' : 'assignment_turned_in');
    $texteBouton = $messageSucces
        ?: ($aDesErreurs ? 'Validation impossible : corrige les erreurs et réessaie' : 'Valider l’étude terrain et synchroniser le dossier');
@endphp

<div class="et">


   <form
    class="et-formulaire"
    action="{{ $action }}"
    method="POST"
    data-simulation="0"
    data-seuil="{{ $seuilLinky }}"
    novalidate
>

            @csrf
            @if (session('success'))
    <p class="et-statut et-statut--ok">
        {{ session('success') }}
    </p>
@endif

@if ($errors->any())
    <div class="et-erreurs">
        @foreach ($errors->all() as $error)
            <p class="et-erreur">{{ $error }}</p>
        @endforeach
    </div>
@endif
            @if (! in_array($method, ['GET', 'POST']))
                @method($method)
            @endif


        <input type="hidden" name="cheminement" value="{{ strtolower($cheminement) }}">

        <div class="et-grille">

            {{-- ===================== COLONNE GAUCHE ===================== --}}
            <div class="et-col">

                {{-- Métré linéaire --}}
                <section class="et-carte">
                    <header class="et-carte-entete">
                        <h2 class="et-carte-titre">
                            <span class="material-symbols-outlined et-icone-orange">straighten</span>
                            Métré Linéaire Terrain
                        </h2>
                        <span class="et-badge et-badge--gris">Tension {{ $tension }}</span>
                    </header>

                    <div class="et-releve">
                        <div class="et-releve-haut">
                            <span class="et-releve-label">
                                <span class="et-point"></span>
                                Portée Poteau → Coffret
                            </span>
                            <span class="et-releve-info">Échantillonnage continu</span>
                        </div>

                        <label class="et-sr-only" for="etLongueur">Longueur mesurée en mètres</label>
                        <div class="et-releve-saisie">
                            <div class="et-saisie @error('longueur') et-saisie--erreur @enderror">
                               <input
    class="et-input-longueur"
    type="number"
    id="etLongueur"
    name="longueur"
    value="{{ $longueurValeur }}"
    step="0.01"
    min="0.01"
    inputmode="decimal"
    autocomplete="off"
    placeholder="0.0"
    required
>
                                <span class="et-unite">mètres</span>
                            </div>
                            <button class="et-modifiable" type="button" data-focus="#etLongueur">
                                <span class="material-symbols-outlined">edit</span>
                                Modifiable
                            </button>
                        </div>
                        @error('longueur')
                            <p class="et-erreur et-erreur--clair">{{ $message }}</p>
                        @enderror

                        <div class="et-releve-bas">
                            <div class="et-stats">
                                <span>Tranchée privée : {{ number_format($distancePrivee, 1, '.', '') }}m</span>
                                <span>Domaine public : {{ number_format($distancePublique, 1, '.', '') }}m</span>
                                <span class="et-stat-chute">Chute estimée : {{ number_format($chute, 2, '.', '') }}% (&lt; {{ $seuilChute }}%)</span>
                            </div>
                            <div class="et-barre" role="img" aria-label="Répartition de la tranchée : {{ $pctPublic }}% domaine public, {{ $pctPrive }}% privé">
                                <div class="et-barre-public" style="width: {{ $pctPublic }}%"></div>
                                <div class="et-barre-prive" style="width: {{ $pctPrive }}%"></div>
                            </div>
                        </div>
                    </div>

                    <div class="et-champ">
                        <span class="et-label">Type de cheminement</span>
                        <div class="et-chip">
                            <span class="material-symbols-outlined">arrow_downward</span>
                            {{ $cheminement }}
                        </div>
                    </div>

                    <div class="et-note">
                        <span class="material-symbols-outlined et-note-icone et-note-icone--bleu">check_circle</span>
                        <div>
                            <p class="et-note-titre">Conformité NFC 14-100 &amp; NF C 15-100</p>
                            <p class="et-note-texte" data-note-long @if ($longueurNum <= $seuilLinky) hidden @endif>
                                Longueur supérieure à {{ $seuilLinky }}m : le comptage Linky sera positionné en <strong>limite de propriété</strong> <span class="et-orange">(Coffret CIBE type 2)</span>.
                            </p>
                            <p class="et-note-texte" data-note-court @if ($longueurNum > $seuilLinky) hidden @endif>
                                Longueur inférieure ou égale à {{ $seuilLinky }}m : positionnement du comptage selon la configuration standard du dossier.
                            </p>
                        </div>
                    </div>
                </section>

                {{-- Autorisation de passage --}}

<section class="et-carte">
    <header class="et-carte-entete">
        <h2 class="et-carte-titre">
            <span class="material-symbols-outlined et-icone-orange">home_pin</span>
            Autorisation de passage requise
        </h2>
        <span class="et-badge et-badge--ambre">Servitude Tiers</span>
    </header>

    <p class="et-texte">
        Le tracé de tranchée le plus court emprunte le chemin d’accès privatif cadastré
        <strong>{{ $parcelle }}</strong> ({{ $proprietaire }}). Une convention de servitude ou accord manuscrit
        est requis pour la pose du raccordement en domaine tiers.
    </p>

    <fieldset class="et-servitude">
        <legend class="et-sr-only">Servitude nécessaire sur {{ $parcelle }}</legend>

        <div class="et-servitude-texte">
            <p class="et-servitude-titre">Servitude nécessaire sur {{ $parcelle }}</p>
            <p class="et-servitude-sous">Active l’obligation de pièce jointe contractuelle</p>
        </div>

        <div class="et-bascule">
            <input
                class="et-radio"
                type="radio"
                id="etServNon"
                name="autorisation"
                value="Non"
                required
                @checked(old('autorisation', $autorisation ?? '') === 'Non')
            >
            <label class="et-bascule-label" for="etServNon">NON</label>

            <input
                class="et-radio"
                type="radio"
                id="etServOui"
                name="autorisation"
                value="Oui"
                required
                @checked(old('autorisation', $autorisation ?? '') === 'Oui')
            >
            <label class="et-bascule-label" for="etServOui">OUI</label>
        </div>
    </fieldset>

    @error('autorisation')
        <p class="et-erreur">{{ $message }}</p>
    @enderror
</section>

                <form action="">
                   <x-Mesure.localisation-picker
    :latitude="$latitude"
    :longitude="$longitude"
    :adresse="$adresse_localisation"
/>
                </form>
            </div>


            <div class="et-col">

                <aside class="et-info">
                    <span class="material-symbols-outlined et-info-icone">info</span>
                    <div>
                        <p class="et-info-titre">Information pour le demandeur ({{ $demandeur }})</p>
                        <p class="et-info-texte">
                            Les photos et mesures terrain sont automatiquement synchronisées pour la génération du devis
                            par l’instructeur. Aucun déplacement supplémentaire n’est requis pour la validation technique.
                        </p>
                    </div>
                </aside>

                <section class="et-validation">
                    <div class="et-validation-texte">
                        <p class="et-validation-titre">
                            {{ $prerequisCompletes ? 'Tous les prérequis techniques sont complétés' : 'Des prérequis techniques restent à compléter' }}
                        </p>
                        <p class="et-validation-sous">Horodatage d’achèvement estimé : {{ $horodatage }}</p>
                    </div>

                    <button
    class="et-bouton {{ $classeBouton }}"
    type="submit"
    data-texte-defaut="Valider l’étude terrain et synchroniser le dossier"
    data-icone-defaut="assignment_turned_in"
>
    <span class="material-symbols-outlined et-bouton-icone">{{ $iconeBouton }}</span>
    <span class="et-bouton-texte">{{ $texteBouton }}</span>
</button>
                        <span class="material-symbols-outlined et-bouton-icone">assignment_turned_in</span>
                        <span class="et-bouton-texte">Valider l’étude terrain et synchroniser le dossier</span>
                    </button>
                </section>

                <p class="et-statut" role="status" aria-live="polite" hidden></p>
            </div>
        </div>
    </form>
</div>

@once
    <script>
        (function () {
            function elementsBouton(form) {
                return {
                    bouton: form.querySelector('.et-bouton'),
                    texte: form.querySelector('.et-bouton-texte'),
                    icone: form.querySelector('.et-bouton-icone')
                };
            }

            // Clic : le bouton tourne
            function etatEnvoi(form) {
                var b = elementsBouton(form);
                b.bouton.classList.remove('et-bouton--ok', 'et-bouton--erreur');
                b.bouton.classList.add('et-bouton--envoi');
                b.bouton.setAttribute('aria-busy', 'true');
                b.icone.textContent = 'refresh';
                b.texte.textContent = 'Transmission à l’instructeur…';
            }

            // Retour au bouton normal
            function etatRepos(form) {
                var b = elementsBouton(form);
                if (!b.bouton) return;
                b.bouton.classList.remove('et-bouton--envoi', 'et-bouton--ok', 'et-bouton--erreur');
                b.bouton.removeAttribute('aria-busy');
                b.bouton.disabled = false;
                b.icone.textContent = b.bouton.dataset.iconeDefaut;
                b.texte.textContent = b.bouton.dataset.texteDefaut;
                form.dataset.envoi = '0';
            }

            // Bouton « Modifiable » : met le focus sur le champ
            document.addEventListener('click', function (e) {
                var btn = e.target.closest('.et-modifiable');
                if (!btn) return;
                var champ = document.querySelector(btn.dataset.focus);
                if (champ) { champ.focus(); champ.select(); }
            });

            // Note de conformité selon la longueur saisie
            document.addEventListener('input', function (e) {
                if (!e.target.matches('.et-input-longueur')) return;
                var form = e.target.closest('.et-formulaire');
                var valeur = parseFloat(String(e.target.value).replace(',', '.'));
                var seuil = parseFloat(form.dataset.seuil);
                var long = form.querySelector('[data-note-long]');
                var court = form.querySelector('[data-note-court]');
                var depasse = !isNaN(valeur) && valeur > seuil;
                long.hidden = !depasse;
                court.hidden = depasse;
            });

            // Soumission
            document.addEventListener('submit', function (e) {
                var form = e.target.closest('.et-formulaire');
                if (!form) return;

                // Anti double envoi
                if (form.dataset.envoi === '1') {
                    e.preventDefault();
                    return;
                }

                var input = form.querySelector('[name="longueur"]');
                var statut = form.querySelector('.et-statut');
                var valeur = parseFloat(String(input.value).replace(',', '.'));

                if (isNaN(valeur) || valeur <= 0) {
                    e.preventDefault();
                    statut.hidden = false;
                    statut.className = 'et-statut et-statut--erreur';
                    statut.textContent = 'Saisis une longueur valide (supérieure à 0).';
                    input.focus();
                    return;
                }

                statut.hidden = true;
                input.value = String(valeur); // point décimal pour le backend

                form.dataset.envoi = '1';
                etatEnvoi(form);
                // La page se recharge : Blade affiche ensuite le message de retour dans le bouton
            });

            // Retour arrière du navigateur : on réinitialise le bouton
            window.addEventListener('pageshow', function (e) {
                if (!e.persisted) return;
                document.querySelectorAll('.et-formulaire').forEach(etatRepos);
            });
        })();
    </script>
@endonce
