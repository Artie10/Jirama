@props(['dossier',
        'mesure' => null,
        'evenements' => collect(),
])

@php
    $dateDepot = $dossier->created_at
        ? $dossier->created_at->format('d/m/Y')
        : 'Non renseignée';

    $statut = $dossier->statut ?? 'En attente';

    $statuts = [
        'en_attente' => 'En attente de traitement',
        'en_cours' => 'Dossier en cours de traitement',
        'valide' => 'Dossier validé',
        'refuse' => 'Dossier refusé',
        'incomplet' => 'Complément demandé',
    ];

    $statutAffiche = $statuts[strtolower($statut)] ?? $statut;

    //Suivi de dossier
        // Étape 1 : dépôt du dossier
    $dateDepot = $dossier->created_at
        ? $dossier->created_at->format('d/m/Y')
        : 'Non renseignée';

    // Étape 2 : visite technique
    $mesureEffectuee = $mesure !== null;

    $dateMesure = $mesure?->date
        ? $mesure->date->format('d/m/Y')
        : null;

    $longueurMesuree = $mesure?->longueur;

    // Étape 3 : calcul du devis
    $autorisationRequise = $mesure?->autorisation === 'Oui';

    // Déterminer l'étape actuelle
    if (!$mesureEffectuee) {
        $etapeActuelle = 2;
    } else {
        $etapeActuelle = 3;
    }
@endphp


<div class="dossier-page">
{{-- En-tête du dossier --}}
<div class="dossier-entete">

    <div class="dossier-infos">
        <span class="dossier-type">
            BRANCHEMENT EAU  RÉSIDENTIEL NEUF
        </span>

        <span class="dossier-date">

            Dossier déposé {{ $dateDepot }}
        </span>

        <span class="dossier-ville">

              {{ $dossier->Nom }}
        </span>
    </div>

    <div class="dossier-titre">
        <h1>Dossier N° {{ $dossier->NumDossier }}</h1>

        <span class="dossier-statut">
            <i class="fas fa-exclamation-circle"></i>
         {{ $statutAffiche }}
        </span>
    </div>

    <p class="dossier-adresse">
      Adresse e-mail : {{ $dossier->Mail }}
        • Téléphone : {{ $dossier->telephone ?? 'Non renseigné' }}
    </p>

</div>


{{-- Notification prioritaire --}}
@if(isset($mesure) && $mesure?->autorisation === 'Oui')

<div class="notification-prioritaire">

    <div class="notification-icone">
        !
    </div>

    <div class="notification-contenu">

        <div class="notification-entete">
            <span class="notification-label">
                NOTIFICATION PRIORITAIRE DE L'INSTRUCTEUR TECHNIQUE
            </span>

            <span class="notification-date">
                • Autorisation nécessaire
            </span>
        </div>

        <h3>
            Autorisation de passage sur terrain privé requise
        </h3>

        <p>
            Suite au tracé technique effectué sur site, l'extension
            nécessite le franchissement d'une propriété privée.
            Une convention signée avec le propriétaire riverain
            est obligatoire pour poursuivre le traitement de votre dossier.
        </p>

    </div>

    <div class="notification-actions">

        <a href="{{ route('devis') }}"
           class="btn-deposer">
            <i class="far fa-file-pdf"></i>
            Déposer le document
        </a>

        <a href="{{ asset('photos/Dossier.png') }}"
           class="btn-modele"
           download>
            <i class="far fa-file-alt"></i>
            Télécharger le modèle type
        </a>

    </div>

</div>

@endif
{{-- Suivi --}}

<div class="cycle-dossier">

    <div class="cycle-header">
        <div>
            <span class="cycle-surtitre">
                ÉTAT D'AVANCEMENT RÉGLEMENTAIRE
            </span>
            <h2>Phases du cycle de raccordement</h2>
        </div>

        <div class="cycle-indicateur">
            <span class="indicateur-point"></span>

            Étape {{ $etapeActuelle }} sur 5 :
            @if($etapeActuelle === 2)
                Visite technique en attente
            @else
                Calcul du devis en attente
            @endif
        </div>
    </div>

    <div class="cycle-etapes">

        {{-- ÉTAPE 1 --}}
        <div class="cycle-etape terminee">

            <div class="etape-icone">✓</div>

            <div class="etape-ligne">
                <span>Étape 1</span>
                <span class="etape-badge">Déposé</span>
            </div>

            <h3>Dépôt & Conformité</h3>

            <p>
                Dossier déposé le {{ $dateDepot }}.
                Statut : {{ $dossier->statut ?? 'En attente' }}.
            </p>

        </div>


        {{-- ÉTAPE 2 --}}
        <div class="cycle-etape {{ $mesureEffectuee ? 'terminee' : 'actuelle' }}">

            <div class="etape-icone">
                {{ $mesureEffectuee ? '✓' : '▤' }}
            </div>

            <div class="etape-ligne">
                <span>
                    Étape 2
                    @if(!$mesureEffectuee)
                        · Actuelle
                    @endif
                </span>

                <span class="etape-badge">
                    @if($mesureEffectuee)
                        {{ $longueurMesuree }} m mesurés
                    @else
                        En attente
                    @endif
                </span>
            </div>

            <h3>Visite Technique Terrain</h3>

            <p>
                @if($mesureEffectuee)
                    Réalisée le {{ $dateMesure }}.
                    Distance réseau mesurée :
                    {{ $longueurMesuree }} m.
                @else
                    La visite technique de votre terrain
                    n'a pas encore été effectuée.
                @endif
            </p>

        </div>


        {{-- ÉTAPE 3 --}}
        <div class="cycle-etape {{ $etapeActuelle === 3 ? 'actuelle' : 'avenir' }}">

            <div class="etape-icone">⊖</div>

            <div class="etape-ligne">
                <span>
                    Étape 3
                    @if($etapeActuelle === 3)
                        · Actuelle
                    @endif
                </span>

                <span class="etape-badge {{ $autorisationRequise ? 'alerte' : '' }}">

                    @if(!$mesureEffectuee)
                        À venir
                    @elseif($autorisationRequise)
                        Attente pièce
                    @else
                        En attente de calcul
                    @endif

                </span>
            </div>

            <h3>Calcul du Devis (PTF)</h3>

            <p>
                @if(!$mesureEffectuee)
                    Cette étape commencera après la visite technique.
                @elseif($autorisationRequise)
                    Une autorisation de passage sur terrain privé
                    est requise.
                @else
                    Votre dossier est en attente de calcul du devis.
                @endif
            </p>

        </div>


        {{-- ÉTAPE 4 --}}
        <div class="cycle-etape avenir">

            <div class="etape-icone">▤</div>

            <div class="etape-ligne">
                <span>Étape 4</span>
                <span class="etape-badge">À venir</span>
            </div>

            <h3>Signature & Travaux</h3>

            <p>
                Validation du devis et planification des travaux
                de raccordement.
            </p>

        </div>


        {{-- ÉTAPE 5 --}}
        <div class="cycle-etape avenir">

            <div class="etape-icone">ϟ</div>

            <div class="etape-ligne">
                <span>Étape 5</span>
                <span class="etape-badge">À venir</span>
            </div>

            <h3>Mise en Service</h3>

            <p>
                Préparation de la mise en service et installation
                du compteur électrique.
            </p>

        </div>

    </div>
</div>


<div class="depot-document">

    {{-- En-tête --}}
    <div class="depot-header">
        <span class="depot-surtitre">ESPACE DE RÉGULARISATION</span>

        <div class="depot-header-ligne">
            <h2>Déposer le document rectificatif</h2>
            <span class="depot-format">Format accepté : PDF, JPG (Max 15 Mo)</span>
        </div>

        <p>
            Ce téléversement direct s'intègre automatiquement au dossier
            <strong>RAC-2025-0842</strong> sans interrompre le délai
            d'instruction initial ni nécessiter une nouvelle demande.
        </p>
    </div>

    {{-- Formulaire --}}
    <form action="{{ route('dossier.modification') }}"
      method="POST"
      enctype="multipart/form-data"
      id="formDepotDocument">
        @csrf

        <div class="depot-section-titre">
            <span>▣ Type de document à joindre :</span>
            <span class="depot-choix-info">Choix du document à régulariser</span>
        </div>

        {{-- Types de documents --}}
        <div class="depot-types">

            <label class="depot-type selected">
                <input type="radio" name="type_document"
                       value="autorisation_passage" checked>

                <span class="type-contenu">
                    <strong>Autorisation de passage / convention</strong>
                    <small>
                        Accord signé du terrain (parcelle B-114)
                        et pièces d'identité associées.
                    </small>
                </span>

                <span class="type-requis">Requis</span>
            </label>

            <label class="depot-type">
                <input type="radio" name="type_document"
                       value="photos_terrain">

                <span class="type-contenu">
                    <strong>Photos du terrain / coffret </strong>
                    <small>
                        Vues d'ensemble de la limite de propriété
                        et des abords techniques.
                    </small>
                </span>
            </label>

            <label class="depot-type">
                <input type="radio" name="type_document"
                       value="piece_identite">

                <span class="type-contenu">
                    <strong>Pièce d'identité (CIN / Passeport)</strong>
                    <small>
                        Copie recto-verso en cours de validité
                        du demandeur ou co-titulaire.
                    </small>
                </span>
            </label>

            <label class="depot-type">
                <input type="radio" name="type_document"
                       value="justificatif_domicile">

                <span class="type-contenu">
                    <strong>Justificatif de domicile / résidence</strong>
                    <small>
                        Facture de moins de 3 mois ou avis de taxe
                        foncière / permis d'aménager.
                    </small>
                </span>
            </label>

        </div>

        {{-- Zone de dépôt --}}
        <label class="depot-zone" id="depotZone" for="fichierDocument">

            <input type="file"
                   name="fichier"
                   id="fichierDocument"
                   accept=".pdf,.jpg,.jpeg,.png"
                   required>

            <span class="depot-icone">☁</span>

            <strong id="depotTexte">
                Glissez-déposez le document sélectionné
                ou parcourez vos fichiers
            </strong>

            <small id="depotNomFichier">
                Doit comporter la signature du propriétaire de la parcelle
                 et la copie de la pièce d'identité afférente.
            </small>

        </label>

        {{-- Note de sécurité --}}
        <div class="depot-securite">
            <span class="securite-icone">♧</span>

            <div>
                <strong>Traçabilité et horodatage certifié</strong>

                <p>
                    Dès versement, votre instructeur est notifié
                    automatiquement. L'étude reprend sous 48 heures
                    ouvrées. Si votre dossier est conforme et entièrement
                    signé, le message de suivi indiquera automatiquement :
                    « Votre dossier est complet, aucune modification
                    nécessaire. Suivi actif. »
                </p>
            </div>
        </div>

        {{-- Bouton d'envoi --}}
        <button type="submit" class="depot-submit">
            Envoyer le document rectificatif
        </button>

    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('fichierDocument');
    const zone = document.getElementById('depotZone');
    const nomFichier = document.getElementById('depotNomFichier');
    const types = document.querySelectorAll('.depot-type');

    // Sélection du type de document
    types.forEach(function (type) {
        type.querySelector('input').addEventListener('change', function () {
            types.forEach(el => el.classList.remove('selected'));
            type.classList.add('selected');
        });
    });

    // Affichage du nom du fichier
    input.addEventListener('change', function () {
        if (this.files.length > 0) {
            nomFichier.textContent = this.files[0].name;
            zone.classList.add('fichier-selectionne');
        }
    });

    // Glisser-déposer
    ['dragenter', 'dragover'].forEach(function (eventName) {
        zone.addEventListener(eventName, function (event) {
            event.preventDefault();
            zone.classList.add('zone-active');
        });
    });

    ['dragleave', 'drop'].forEach(function (eventName) {
        zone.addEventListener(eventName, function (event) {
            event.preventDefault();
            zone.classList.remove('zone-active');
        });
    });

    zone.addEventListener('drop', function (event) {
        if (event.dataTransfer.files.length > 0) {
            input.files = event.dataTransfer.files;
            input.dispatchEvent(new Event('change'));
        }
    });
});
</script>

{{-- JOURNAL DES EVENEMENTS --}}
<div class="journal-evenements">

    {{-- En-tête --}}
    <div class="journal-header">
        <h2>Journal des événements & Traçabilité</h2>

        <span class="journal-temps-reel">
            <span class="temps-reel-point"></span>
            Temps réel
        </span>
    </div>

    {{-- Timeline --}}
    <div class="journal-timeline">

        @php
            $icones = [
                'alerte' => '▣',
                'technique' => '▤',
                'affectation' => '♙',
                'validation' => '✓',
            ];
        @endphp

        @forelse($evenements as $evenement)

            <div class="journal-item">

                <div class="journal-icon icon-{{ $evenement->type }}">
                    <span>{{ $icones[$evenement->type] ?? '•' }}</span>
                </div>

                <div class="journal-contenu">

                    <div class="journal-titre-ligne">
                        <h3>{{ $evenement->titre }}</h3>

                        <span class="journal-date">
                            {{ $evenement->created_at
                                ->locale('fr')
                                ->translatedFormat('d M Y, à H:i') }}
                        </span>
                    </div>

                    <p>{{ $evenement->description }}</p>

                    @if($evenement->acteur)
                        <p>Acteur : {{ $evenement->acteur }}</p>
                    @endif

                </div>

            </div>

        @empty

            <div class="journal-item">
                <div class="journal-contenu">
                    <h3>Aucun événement pour le moment</h3>
                    <p>
                        Les actions effectuées sur votre dossier
                        apparaîtront ici automatiquement.
                    </p>
                </div>
            </div>

        @endforelse

    </div>
</div>


{{-- Estimation MAT ET dEVIS --}}

<div class="panneau-devis">

    {{-- 1. Paramètres techniques --}}

@php
    $mesure = $dossier->mesures
        ->sortByDesc('date')
        ->first();
@endphp

<section class="parametres-techniques">

    <div class="parametres-header">
        <h3>Paramètres techniques</h3>
        <span class="parametres-icone">☷</span>
    </div>

    @if($mesure)

        <div class="parametre-ligne">
            <span>Numéro de mesure</span>
            <strong>{{ $mesure->NumMesure }}</strong>
        </div>

        <div class="parametre-ligne">
            <span>Longueur mesurée</span>
            <strong>{{ $mesure->longueur }} mètres</strong>
        </div>

        <div class="parametre-ligne">
            <span>Autorisation</span>
            <strong>
                {{ $mesure->autorisation }}
            </strong>
        </div>

    @else

        <div class="mesure-attente">
            <span><img src="/public/photos/Attente.png" alt=""></span>
            <strong>Prise de mesure en attente</strong>
            <p>
                Ces informations seront disponibles après
                la prise de mesure sur le terrain.
            </p>
        </div>

    @endif

</section>



    {{-- 2. Contact instructeur --}}
<section class="contact-instructeur">

        <a href="{{ route('devis') }}"
           class="contact-question">
            <span>▣</span>
            Poser une question à l'instructeur
        </a>

        <a href="tel:0240000018" class="contact-telephone">
            <span>☎</span>
            Ligne directe : 02 40 ** ** 18
        </a>

    </section>


    {{-- 3. Estimation du devis --}}

@php
    $mesure = $dossier->mesures
        ->sortByDesc('date')
        ->first();

    $dossierValide = strtolower(trim($dossier->statut ?? '')) === 'valide';

    $estimationDisponible = $mesure && $dossierValide;
@endphp

<section class="estimation-card">

    <div class="estimation-header">
        <span>ESTIMATION INDICATIVE</span>
        <span class="estimation-icone">▦</span>
    </div>

    @if($estimationDisponible)

        <div class="estimation-prix">
            Estimation en cours
        </div>

        <div class="estimation-details">
            Mesure effectuée et dossier validé
        </div>

        <p class="estimation-description">
            Votre dossier a été mesuré et validé.
            Le montant estimatif sera communiqué après
            l'établissement de votre estimation par un employé.
        </p>

    @else

        <div class="estimation-prix">
            En attente
        </div>

        <div class="estimation-details">
            Estimation non disponible pour le moment
        </div>

        <p class="estimation-description">
            L'estimation indicative sera disponible après
            la prise de mesure sur le terrain et la validation
            de votre dossier par un employé.
        </p>

    @endif

</section>


</div>
</div>
