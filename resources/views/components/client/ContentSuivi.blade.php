
{{-- En-tête du dossier --}}
<div class="dossier-entete">

    <div class="dossier-infos">
        <span class="dossier-type">
            BRANCHEMENT EAU  RÉSIDENTIEL NEUF
        </span>

        <span class="dossier-date">
            <i class="far fa-calendar"></i>
            Dossier déposé le 12 Fév. 2025
        </span>

        <span class="dossier-ville">
            <i class="fas fa-map-marker-alt"></i>
            Nantes (44200)
        </span>
    </div>

    <div class="dossier-titre">
        <h1>Dossier N° RAC-2025-0842</h1>

        <span class="dossier-statut">
            <i class="fas fa-exclamation-circle"></i>
            Action requise : Complément demandé
        </span>
    </div>

    <p class="dossier-adresse">
        Parcelle B-112, Lieu-dit Le Chêne Vert, 44200 Nantes
        • Gestionnaire délégué Enedis Loire-Atlantique.
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
