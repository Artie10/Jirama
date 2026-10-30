@props(['dossier'])

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
                • Reçue hier à 16:42
            </span>
        </div>

        <h3>
            Autorisation de passage sur terrain privé requise
            (Parcelle B-114)
        </h3>

        <p>
            Suite au tracé technique effectué sur site le 24 février
            par nos équipes, l'extension nécessite le franchissement
            de la limite cadastrale voisine. Une convention manuscrite
            signée avec le propriétaire riverain est obligatoire pour
            finaliser le dimensionnement hydraulique et émettre votre
            proposition technique et financière (PTF).
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
            Étape 3 sur 5 : Calcul du devis en cours d'ajustement
        </div>
    </div>

    <div class="cycle-etapes">

        {{--  1 --}}
        <div class="cycle-etape terminee">
            <div class="etape-icone">✓</div>

            <div class="etape-ligne">
                <span>Étape 1</span>
                <span class="etape-badge">Validé</span>
            </div>

            <h3>Dépôt & Conformité</h3>
            <p>Dossier complété et pièces d'identité validées le 12/02.</p>
        </div>

        {{--  2  --}}
        <div class="cycle-etape terminee">
            <div class="etape-icone">▤</div>

            <div class="etape-ligne">
                <span>Étape 2</span>
                <span class="etape-badge">38.5 m mesurés</span>
            </div>

            <h3>Visite Technique Terrain</h3>
            <p>Réalisée le 24/02 par Tech. E. Girard. Distance réseau fixée.</p>
        </div>

        {{-- 3 --}}
        <div class="cycle-etape actuelle">
            <div class="etape-icone">⊖</div>

            <div class="etape-ligne">
                <span>Étape 3 · Actuelle</span>
                <span class="etape-badge alerte">Attente pièce</span>
            </div>

            <h3>Calcul du Devis (PTF)</h3>
            <p>Blocage administratif : convention de servitude requise.</p>
        </div>

        {{--  4  --}}
        <div class="cycle-etape avenir">
            <div class="etape-icone">▤</div>

            <div class="etape-ligne">
                <span>Étape 4</span>
                <span class="etape-badge">À venir</span>
            </div>

            <h3>Signature & Travaux</h3>
            <p>Validation devis, planification tranchées et coffret CIBE.</p>
        </div>

        {{-- 5  --}}
        <div class="cycle-etape avenir">
            <div class="etape-icone">ϟ</div>

            <div class="etape-ligne">
                <span>Étape 5</span>
                <span class="etape-badge">À venir</span>
            </div>

            <h3>Mise en Service</h3>
            <p>Attestation Consuel requise avant pose du compteur Linky.</p>
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
    <form action="{{ route('devis') }}"
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
                    <strong>Photos du terrain / coffret / poteau</strong>
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
                B-114 et la copie de la pièce d'identité afférente.
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

{{-- JOURNALDESUIVI --}}

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

        {{-- Événement 1 --}}
        <div class="journal-item">
            <div class="journal-icon icon-alerte">
                <span>▣</span>
            </div>

            <div class="journal-contenu">
                <div class="journal-titre-ligne">
                    <h3>Demande de pièce complémentaire & Notification SMS</h3>
                    <span class="journal-date">Hier, à 16:42</span>
                </div>

                <p>
                    Avis d'arrêt temporaire d'instruction émis par
                    Ing. M. Laurent. Notification SMS adressée au
                    +33 6 ** ** 78 12.
                </p>
            </div>
        </div>

        {{-- Événement 2 --}}
        <div class="journal-item">
            <div class="journal-icon icon-technique">
                <span>▤</span>
            </div>

            <div class="journal-contenu">
                <div class="journal-titre-ligne">
                    <h3>Visite technique terrain clôturée</h3>
                    <span class="journal-date">24 Fév. 2025, à 11:15</span>
                </div>

                <p>
                    Mesure laser définitive : 38.5 mètres depuis le
                    poste HTA/BT « Les Marais ». Présence d'un muret
                    mitoyen notée sur le PV technique n° VT-44-8902.
                </p>
            </div>
        </div>

        {{-- Événement 3 --}}
        <div class="journal-item">
            <div class="journal-icon icon-affectation">
                <span>♙</span>
            </div>

            <div class="journal-contenu">
                <div class="journal-titre-ligne">
                    <h3>Affectation à la cellule ingénierie territoriale</h3>
                    <span class="journal-date">16 Fév. 2025, à 09:30</span>
                </div>

                <p>
                    Dossier déclaré recevable administrativement.
                    Référent technique désigné : M. Laurent
                    (Pôle Raccordement Loire-Atlantique).
                </p>
            </div>
        </div>

        {{-- Événement 4 --}}
        <div class="journal-item">
            <div class="journal-icon icon-validation">
                <span>✓</span>
            </div>

            <div class="journal-contenu">
                <div class="journal-titre-ligne">
                    <h3>Enregistrement initial du dossier en ligne</h3>
                    <span class="journal-date">12 Fév. 2025, à 14:08</span>
                </div>

                <p>
                    Téléversement du permis de construire PC 044 109 24
                    P0034 et plan de masse cadastral.
                </p>
            </div>
        </div>

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
