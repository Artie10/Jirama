{{--
    Composant Blade : dossier-instruction
    Utilisation : <x-dossier-instruction />
    Dépendances : Material Symbols + Google Fonts (chargés ci-dessous), CSS pur : public/css/TraitementDossierA.css
--}}
@props(['dossier', 'mesure' => null])
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200"
    rel="stylesheet">
<link
    href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Plus+Jakarta+Sans:wght@100..900&display=swap"
    rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/TraitementDossierA.css') }}">

<aside id="vr-sidebar">
    <div class="vr-sidebar__top">
        <div class="vr-brand">
            <img class="vr-brand__logo" alt="Logo VoltaRéseau Bleu & Orange"
                src="https://lh3.googleusercontent.com/aida/AEtjO1WpgRULcquGjhMFPox54PpJfpQ6Jx4LuNxgL8TwLV_jYeGoMjzOFiJDiMlYU6rb6E2MbcCfvP9pzImSy1iXSwmmizabeQIg2JtjdI3ztnWSq4EbEsAaKDD2weXH1V6FQPmuZekAMd55IT5uoF8dwvOYKiNi9ANWfG31zvqEG5b8QQ-YkuXG76iMuQcHbZ40VdtuDvmO_IE47tQfofs74jplsRvIcJm2mP5m2oOkKFuXgfnsvyk20BY6SPA" />
            <div class="vr-brand__text">
                <span class="vr-brand__name">VoltaRéseau</span>
                <span class="vr-brand__sub">Poste d'Instruction</span>
            </div>
        </div>
        <div class="vr-portal">
            <div class="vr-portal__inner">
                <span class="vr-portal__dot"></span>
                <span class="vr-portal__label">Portail Ingénierie & Admin</span>
            </div>
        </div>

    </div>
    <div class="vr-sidebar__bottom">
        <div class="vr-user">
            <div class="vr-user__info">
                <img class="vr-avatar" alt="Profile"
                    src="https://lh3.googleusercontent.com/aida/AEtjO1WcYRmghDZ0SCqvLZSVnAE8ZmbnFL1sqVeSQM_TPhrvhGJb27knXdjq91--pgeAVrt8lq-pDTgS7mHhubSHAJpLpx0MS1NS_OczxtmCfROY5zQOgFSLMk5Nz0hp98eWDIlSooLTnv0lKlt9OM20cKTnNlCGwG3znBLFIlTtegTp0TpE_dC8bwOubD_PTMmtQjhNtfyXJHKFB0h_EjNy4-YC5Ew2VD7MO8C7UIzccbkKNWatlsygMz_jHw" />
                <div class="vr-user__text">
                    <span class="vr-user__name">Agent ADMIN</span>
                    <span class="vr-user__role">Pôle Raccordement</span>
                </div>
            </div>
            <a class="vr-user__logout" data-path="portail-connexion" href="#" title="Se déconnecter">
                <span class="material-symbols-outlined">power_settings_new</span>
            </a>
        </div>
    </div>
</aside>

<div class="vr-main-wrapper">
    <header id="vr-header">
        <div class="vr-header__left">
            <span class="vr-status-label">
                <span class="vr-status-dot"></span>Réseau National RTE/Enedis • Synchronisé
            </span>
        </div>
        <div class="vr-header__right">

            <div class="vr-divider"></div>
            <button class="vr-icon-btn">
                <span class="material-symbols-outlined">notifications</span>
            </button>
            <img class="vr-avatar" alt="Profile"
                src="https://lh3.googleusercontent.com/aida/AEtjO1WcYRmghDZ0SCqvLZSVnAE8ZmbnFL1sqVeSQM_TPhrvhGJb27knXdjq91--pgeAVrt8lq-pDTgS7mHhubSHAJpLpx0MS1NS_OczxtmCfROY5zQOgFSLMk5Nz0hp98eWDIlSooLTnv0lKlt9OM20cKTnNlCGwG3znBLFIlTtegTp0TpE_dC8bwOubD_PTMmtQjhNtfyXJHKFB0h_EjNy4-YC5Ew2VD7MO8C7UIzccbkKNWatlsygMz_jHw" />
        </div>
    </header>

    <main class="vr-main">
        <div class="vr-page">

            {{-- Super-Header & Dossier Summary Banner --}}
            <div class="vr-hero">
                <div class="vr-hero__glow vr-hero__glow--a"></div>
                <div class="vr-hero__glow vr-hero__glow--b"></div>

                <div class="vr-hero__inner">

                    <div class="vr-hero__main">

                        <div class="vr-hero__tags">

                            <span class="vr-tag">
                                Branchement neuf eau
                            </span>

                            <span class="vr-tag vr-tag--phase">
                                <span class="vr-pulse"></span>
                                Instruction du dossier
                            </span>

                            <span class="vr-hero__date">
                                Soumis le
                                {{ $dossier->created_at ? $dossier->created_at->format('d/m/Y') : 'Date inconnue' }}
                            </span>

                        </div>

                        <h1 class="vr-hero__title">

                            <span>
                                Dossier #{{ $dossier->NumDossier }}
                            </span>

                            <span class="vr-hero__sep">|</span>

                            <span class="vr-hero__client">
                                {{ $dossier->Nom }}
                            </span>

                        </h1>

                        <p class="vr-hero__addr">

                            <span class="material-symbols-outlined">
                                location_on
                            </span>

                            {{ $mesure && $mesure->adresse_localisation
                                ? $mesure->adresse_localisation
                                : 'Localisation du terrain en attente de renseignement' }}

                        </p>

                    </div>

                    {{-- Action Chips Quick KPI --}}
                    <div class="vr-kpis">

                        <div class="vr-kpi">

                            <span class="vr-kpi__label">
                                Référence du dossier
                            </span>

                            <span class="vr-kpi__value">
                                {{ $dossier->NumDossier }}
                            </span>

                        </div>

                        <div class="vr-kpi">

                            <span class="vr-kpi__label">
                                Type de demande
                            </span>

                            <span class="vr-kpi__value vr-kpi__value--accent">
                                Branchement neuf eau
                            </span>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Stepper Workflow Ribbon -->
            @php
                // L'expertise terrain est considérée disponible
                // lorsqu'une mesure existe pour ce dossier.
                $expertiseTerminee = $mesure !== null;

                // La phase d'instruction commence après l'expertise.
                $instructionActive = $expertiseTerminee;
            @endphp

            <div class="vr-stepper">

                {{-- ÉTAPE 1 : DÉPÔT INITIAL --}}
                <div class="vr-step vr-step--first vr-step--done">

                    <div class="vr-step__badge">
                        <span class="material-symbols-outlined">check</span>
                    </div>

                    <div class="vr-step__txt">
                        <span class="vr-step__title">
                            1. Dépôt initial
                        </span>

                        <span class="vr-step__sub">
                            Dossier enregistré
                        </span>
                    </div>

                </div>

                <div class="vr-step-line vr-step-line--done"></div>


                {{-- ÉTAPE 2 : EXPERTISE TERRAIN --}}
                <div class="vr-step
        {{ $expertiseTerminee ? 'vr-step--done' : 'vr-step--active' }}">

                    <div class="vr-step__badge">

                        @if ($expertiseTerminee)
                            <span class="material-symbols-outlined">check</span>
                        @else
                            <span class="material-symbols-outlined">location_on</span>
                        @endif

                    </div>

                    <div class="vr-step__txt">

                        <span class="vr-step__title">
                            2. Expertise terrain
                        </span>

                        <span class="vr-step__sub">
                            {{ $expertiseTerminee ? 'Mesure renseignée' : 'En attente de mesure terrain' }}
                        </span>

                    </div>

                </div>

                <div class="vr-step-line
        {{ $expertiseTerminee ? 'vr-step-line--done' : '' }}">
                </div>


                {{-- ÉTAPE 3 : INSTRUCTION & DEVIS --}}
                <div class="vr-step
        {{ $instructionActive ? 'vr-step--active' : 'vr-step--todo' }}">

                    <div class="vr-step__badge">

                        @if ($instructionActive)
                            <span class="material-symbols-outlined">water_drop</span>
                        @else
                            <span>3</span>
                        @endif

                    </div>

                    <div class="vr-step__txt">

                        <span class="vr-step__title">
                            3. Instruction & devis
                        </span>

                        <span class="vr-step__sub">
                            {{ $instructionActive ? 'Instruction en cours' : 'En attente de l’expertise terrain' }}
                        </span>

                    </div>

                </div>

                <div class="vr-step-line"></div>


                {{-- ÉTAPE 4 : SIGNATURE & TRAVAUX --}}
                <div class="vr-step vr-step--todo">

                    <div class="vr-step__badge">
                        4
                    </div>

                    <div class="vr-step__txt">

                        <span class="vr-step__title">
                            4. Signature & travaux
                        </span>

                        <span class="vr-step__sub">
                            En attente du devis et de l'accord
                        </span>

                    </div>

                </div>

            </div>
            <!-- Operational Grid: 3 Pillars of Control -->
            <div class="vr-grid">
                <!-- COLONNE 1 : Dossier Client & Pièces Justificatives -->
                <div class="vr-col">
                    <div class="vr-card">

                        <div class="vr-card__head">
                            <div class="vr-card__title">
                                <span class="material-symbols-outlined">inventory_2</span>
                                <h2>Dossier & Pièces Justificatives</h2>
                            </div>

                            <span class="vr-chip">
                                3 pièces déposées
                            </span>
                        </div>

                        <p class="vr-card__intro">
                            Vérification des pièces justificatives requises
                            pour la demande de branchement neuf en eau.
                        </p>

                        <div class="vr-docs">

                            {{-- DOCUMENT 1 : DEMANDE MANUSCRITE --}}
                            <div class="vr-doc">

                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">

                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">
                                                assignment
                                            </span>
                                        </span>

                                        <div class="vr-doc__meta">

                                            <span class="vr-doc__name">
                                                Demande de branchement signée
                                            </span>

                                            <span class="vr-doc__sub">
                                                Demande manuscrite du client
                                            </span>

                                            <span class="vr-doc__date">
                                                Déposé le
                                                {{ $dossier->created_at ? $dossier->created_at->format('d/m/Y') : 'Date inconnue' }}
                                            </span>

                                        </div>
                                    </div>

                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">
                                            description
                                        </span>
                                        Déposée
                                    </span>
                                </div>

                                <div class="vr-doc__bottom">

                                    <span class="vr-doc__size">
                                        Document du dossier
                                    </span>

                                    @if ($dossier->Dmd_img)
                                        <a href="{{ Storage::url($dossier->Dmd_img) }}" target="_blank"
                                            class="vr-link-btn">
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>
                                            Consulter
                                        </a>
                                    @else
                                        <span>Document indisponible</span>
                                    @endif

                                </div>
                            </div>


                            {{-- DOCUMENT 2 : JUSTIFICATIF DE DOMICILE --}}
                            <div class="vr-doc">

                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">

                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">
                                                home
                                            </span>
                                        </span>

                                        <div class="vr-doc__meta">

                                            <span class="vr-doc__name">
                                                Justificatif de domicile
                                            </span>

                                            <span class="vr-doc__sub">
                                                Justification de la résidence du demandeur
                                            </span>

                                            <span class="vr-doc__date">
                                                Déposé lors de la demande
                                            </span>

                                        </div>
                                    </div>

                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">
                                            description
                                        </span>
                                        Déposé
                                    </span>
                                </div>

                                <div class="vr-doc__bottom">

                                    <span class="vr-doc__size">
                                        Document du dossier
                                    </span>

                                    @if ($dossier->residence_img)
                                        <a href="{{ Storage::url($dossier->residence_img) }}" target="_blank"
                                            class="vr-link-btn">
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>
                                            Consulter
                                        </a>
                                    @else
                                        <span>Document indisponible</span>
                                    @endif

                                </div>
                            </div>


                            {{-- DOCUMENT 3 : CIN --}}
                            <div class="vr-doc">

                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">

                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">
                                                badge
                                            </span>
                                        </span>

                                        <div class="vr-doc__meta">

                                            <span class="vr-doc__name">
                                                Pièce d'identité (CIN)
                                            </span>

                                            <span class="vr-doc__sub">
                                                Identité du demandeur :
                                                {{ $dossier->Nom }}
                                            </span>

                                            <span class="vr-doc__date">
                                                Copie de la pièce d'identité déposée
                                            </span>

                                        </div>
                                    </div>

                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">
                                            description
                                        </span>
                                        Déposée
                                    </span>
                                </div>

                                <div class="vr-doc__bottom">

                                    <span class="vr-doc__size">
                                        Document du dossier
                                    </span>

                                    @if ($dossier->cin_document)
                                        <a href="{{ Storage::url($dossier->cin_document) }}" target="_blank"
                                            class="vr-link-btn">
                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>
                                            Consulter
                                        </a>
                                    @else
                                        <span>Document indisponible</span>
                                    @endif

                                </div>
                            </div>

                        </div>


                        {{-- PROFIL DU DEMANDEUR --}}
                        <div class="vr-contact">

                            <div class="vr-contact__head">
                                <span class="material-symbols-outlined">
                                    account_box
                                </span>

                                <span>
                                    Contact du demandeur
                                </span>
                            </div>

                            <div class="vr-contact__grid">

                                <span>Téléphone :</span>

                                <span class="vr-contact__phone">
                                    {{ $dossier->telephone ?? 'Non renseigné' }}
                                </span>

                                <span>Courriel :</span>

                                <span>
                                    {{ $dossier->Mail ?? 'Non renseigné' }}
                                </span>

                                <span>Statut du demandeur :</span>

                                <span>
                                    {{ $dossier->statut_demandeur ?? 'Non renseigné' }}
                                </span>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- COLONNE 2 : Relevé Maître Mesure -->
                <div class="vr-col">
                    <div class="vr-card">

                        {{-- EN-TÊTE --}}
                        <div class="vr-card__head">

                            <div class="vr-card__title">
                                <span class="material-symbols-outlined">
                                    straighten
                                </span>

                                <h2>Relevé Maître Mesure</h2>
                            </div>

                            <span class="vr-chip vr-chip--ref">
                                Réf:
                                {{ $mesure ? $mesure->NumMesure : 'En attente' }}
                            </span>

                        </div>


                        {{-- DISTANCE --}}
                        <div class="vr-metrics">

                            <div class="vr-metric">

                                <span class="vr-metric__label">
                                    Distance Réseau-Terrain
                                </span>

                                <div class="vr-metric__value">

                                    <span class="vr-metric__num">
                                        {{ $mesure && $mesure->longueur !== null ? $mesure->longueur : '--' }}
                                    </span>

                                    <span class="vr-metric__unit">
                                        mètres
                                    </span>

                                </div>

                            </div>

                        </div>


                        {{-- AUTORISATION DE PASSAGE --}}
                        <div class="vr-servitude">

                            <span class="vr-servitude__icon">
                                <span class="material-symbols-outlined">
                                    handshake
                                </span>
                            </span>

                            <div class="vr-servitude__body">

                                <div class="vr-servitude__row">

                                    <span class="vr-servitude__title">
                                        Autorisation de passage
                                    </span>

                                    <span class="vr-badge">

                                        {{ $mesure && $mesure->autorisation ? $mesure->autorisation : 'En attente' }}

                                    </span>

                                </div>


                                {{-- DESCRIPTION --}}
                                <p class="vr-servitude__text">

                                    @if ($mesure && strtolower(trim($mesure->autorisation)) === 'utile')
                                        Une autorisation de passage est nécessaire
                                        pour la réalisation du branchement.
                                    @elseif($mesure && strtolower(trim($mesure->autorisation)) === 'inutile')
                                        Aucune autorisation de passage n'est nécessaire
                                        selon le relevé terrain.
                                    @else
                                        La nécessité d'une autorisation de passage
                                        n'a pas encore été renseignée.
                                    @endif

                                </p>


                                {{-- MÉTADONNÉES --}}
                                <div class="vr-servitude__meta">

                                    <span>

                                        @if ($dossier->autorisation_img)
                                            Document déposé
                                        @else
                                            Aucun document déposé
                                        @endif

                                    </span>

                                    @if ($mesure && $mesure->date)
                                        <span>
                                            Relevé :
                                            {{ \Carbon\Carbon::parse($mesure->date)->format('d/m/Y') }}
                                        </span>
                                    @endif

                                </div>


                                {{-- BOUTON CONSULTER --}}
                                @if ($dossier->autorisation_img)
                                    <div class="vr-doc__bottom">

                                        <a href="{{ \Illuminate\Support\Facades\Storage::url($dossier->autorisation_img) }}"
                                            target="_blank" class="vr-link-btn">

                                            <span class="material-symbols-outlined">
                                                visibility
                                            </span>

                                            Consulter l'autorisation

                                        </a>

                                    </div>
                                @endif

                            </div>

                        </div>


                        {{-- LOCALISATION GOOGLE MAPS --}}
                        <div class="vr-map">

                            <div class="vr-map-top">

                                <span>
                                    Localisation du terrain
                                </span>

                                <span>

                                    {{ $mesure && $mesure->latitude !== null && $mesure->longitude !== null ? 'Localisée' : 'En attente' }}

                                </span>

                            </div>


                            {{-- SI LES COORDONNÉES EXISTENT --}}
                            @if ($mesure && $mesure->latitude !== null && $mesure->longitude !== null)
                                <div style="width:100%; height:250px; overflow:hidden;">

                                    <iframe width="100%" height="100%" style="border:0;" loading="lazy"
                                        allowfullscreen referrerpolicy="no-referrer-when-downgrade"
                                        src="https://maps.google.com/maps?q={{ $mesure->latitude }},{{ $mesure->longitude }}&z=17&output=embed">
                                    </iframe>

                                </div>
                            @else
                                {{-- SI LES COORDONNÉES SONT ABSENTES --}}
                                <div
                                    style="min-height:180px; display:flex; align-items:center; justify-content:center; text-align:center;">

                                    <p>

                                        <span class="material-symbols-outlined">
                                            location_on
                                        </span>

                                        <br>

                                        La localisation sera disponible
                                        après l'enregistrement des coordonnées terrain.

                                    </p>

                                </div>
                            @endif


                            {{-- LÉGENDE --}}
                            <div class="vr-map-legend">

                                <span>

                                    Localisation :

                                    {{ $mesure && $mesure->latitude !== null && $mesure->longitude !== null ? 'Renseignée' : 'Non renseignée' }}

                                </span>

                                <strong>

                                    {{ $mesure && $mesure->latitude !== null && $mesure->longitude !== null ? 'Disponible' : 'En attente' }}

                                </strong>

                            </div>

                        </div>


                    </div>
                </div>

                <!-- COLONNE 3 : Calculateur & Devis -->

                <div class="vr-col">
                    <div class="vr-card">
                        <div class="vr-card__head">
                            <div class="vr-card__title">
                                <span class="material-symbols-outlined">calculate</span>
                                <h2>Calculateur & Devis Branchement Eau</h2>
                            </div>
                            <span class="vr-chip vr-chip--blue">Barème JIRAMA</span>
                        </div>

                        <p class="vr-card__intro">
                            Estimation automatisée des frais de main-d'œuvre liés à l'installation
                            des équipements nécessaires au branchement d'eau.
                        </p>

                        <div class="vr-lines">

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Bouche à clé tête ronde</span>
                                    <span class="vr-line__sub">Quantité : 1 unité par branchement</span>
                                </div>
                                <span class="vr-line__amount">10 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Pose du compteur d'eau</span>
                                    <span class="vr-line__sub">1 pose par compteur — compteur fourni par la
                                        JIRAMA</span>
                                </div>
                                <span class="vr-line__amount">8 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Niche compteur classique</span>
                                    <span class="vr-line__sub">Placement : 1 unité par compteur</span>
                                </div>
                                <span class="vr-line__amount">15 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Coude 1/4 Galva FF 26×34</span>
                                    <span class="vr-line__sub">Placement selon le nombre de changements de
                                        direction</span>
                                </div>
                                <span class="vr-line__amount">5 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Robinet d'arrêt DN 15</span>
                                    <span class="vr-line__sub">Placement : 1 unité par compteur</span>
                                </div>
                                <span class="vr-line__amount">8 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Mamelon fileté droit 1521 Galva</span>
                                    <span class="vr-line__sub">Placement : 1 unité par branchement</span>
                                </div>
                                <span class="vr-line__amount">4 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Colle PVC en tube 125 MG</span>
                                    <span class="vr-line__sub">Fournie par la JIRAMA — sans frais de placement
                                        facturés</span>
                                </div>
                                <span class="vr-line__amount">Fournie</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Béton pour butée et calage</span>
                                    <span class="vr-line__sub">Quantité forfaitaire : 0,02 m³ par branchement</span>
                                </div>
                                <span class="vr-line__amount">12 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Bouche à clé</span>
                                    <span class="vr-line__sub">Placement : 1 unité par robinet d'arrêt</span>
                                </div>
                                <span class="vr-line__amount">10 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Tuyau PVC 16 bars DN 32</span>
                                    <span class="vr-line__sub">Longueur mesurée + 10 % de marge</span>
                                </div>
                                <span class="vr-line__amount">3 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Robinet PC 25</span>
                                    <span class="vr-line__sub">Placement : 1 unité par compteur</span>
                                </div>
                                <span class="vr-line__amount">7 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Collier GB/PVC 63</span>
                                    <span class="vr-line__sub">Placement : 1 unité par compteur</span>
                                </div>
                                <span class="vr-line__amount">6 000 Ar</span>
                            </div>

                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Tuyau Galva 26×34</span>
                                    <span class="vr-line__sub">Placement : 1 unité par compteur</span>
                                </div>
                                <span class="vr-line__amount">8 000 Ar</span>
                            </div>
                        </div>

                        <div class="vr-subtotals">
                            <div class="vr-subtotals__row">
                                <span>Total main-d'œuvre HT :</span>
                                <span>Calculé automatiquement</span>
                            </div>
                            <div class="vr-subtotals__row">
                                <span>TVA applicable (20 %) :</span>
                                <span>Calculée automatiquement</span>
                            </div>
                        </div>

                        <div class="vr-total">
                            <span class="vr-total__label">Montant total estimatif à payer</span>
                            <div class="vr-total__amount">
                                À calculer <span class="vr-total__cur">Ar TTC</span>
                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <!-- Checklist de validation réglementaire & actions -->
            <div class="vr-checks">
                <div class="vr-checks__head">
                    <div class="vr-checks__title">
                        <span class="material-symbols-outlined">verified_user</span>
                        <h3>Contrôles de Sécurité & Conformité NF C 14-100</h3>
                    </div>
                    <span class="vr-checks__status">
                        <span class="vr-status-dot"></span> Audit automatisé franchi sans réserve bloquante
                    </span>
                </div>
                <div class="vr-checks__grid">
                    <label class="vr-check">
                        <input type="checkbox" checked />
                        <div class="vr-check__txt">
                            <span class="vr-check__title">Norme NF C 14-100</span>
                            <span class="vr-check__text">Liaison en domaine privé conforme aux prescriptions de
                                comptage limite.</span>
                        </div>
                    </label>
                    <label class="vr-check">
                        <input type="checkbox" checked />
                        <div class="vr-check__txt">
                            <span class="vr-check__title">Tension & Perturbation</span>
                            <span class="vr-check__text">Capacité d'accueil poste HTA vérifiée, impédance de boucle
                                conforme.</span>
                        </div>
                    </label>
                    <label class="vr-check vr-check--orange">
                        <input type="checkbox" checked />
                        <div class="vr-check__txt">
                            <span class="vr-check__title">Servitude Tranchée</span>
                            <span class="vr-check__text">Autorisation riveraine B-114 archivée et vérifiée au greffe
                                hypothécaire.</span>
                        </div>
                    </label>
                    <label class="vr-check vr-check--orange">
                        <input type="checkbox" checked />
                        <div class="vr-check__txt">
                            <span class="vr-check__title">Autorisation Voirie (DICT)</span>
                            <span class="vr-check__text">Emprise domaine public municipal enregistrée sous téléservice
                                Guichet Unique.</span>
                        </div>
                    </label>
                </div>
                <div class="vr-actions-bar">
                    <div class="vr-actions-note">
                        <span class="material-symbols-outlined">mark_email_read</span>
                        <span>Validation déclenchant l'envoi immédiat de la proposition technique par email
                            sécurisé.</span>
                    </div>
                    <div class="vr-action-buttons">
                        <button class="vr-btn vr-btn--ghost" id="btn-request-info">
                            <span class="material-symbols-outlined">announcement</span>
                            Demander un complément
                        </button>
                        <button class="vr-btn vr-btn--outline">
                            <span class="material-symbols-outlined">print</span>
                            Brouillon Devis PDF
                        </button>
                        <button class="vr-btn vr-btn--primary" id="btn-validate-dossier">
                            <span class="material-symbols-outlined">send_time_extension</span>
                            Valider le dossier et générer le devis estimatif
                        </button>
                    </div>
                </div>
            </div>

            <!-- Toast de confirmation -->
            <div id="action-toast">
                <div class="vr-toast__icon">
                    <span class="material-symbols-outlined">check</span>
                </div>
                <div class="vr-toast__txt">
                    <span class="vr-toast__title">Dossier #RAC-2025-0842 Validé</span>
                    <span class="vr-toast__msg">Devis de 1 970,40 € transmis à M. Dupont
                        (m.dupont@ouest-mail.fr).</span>
                </div>
            </div>
        </div>
    </main>

    <footer class="vr-footer">
        <span>Plateforme VoltaRéseau • Direction Technique de Distribution • NF C 14-100</span>
        <span class="vr-footer__version">v4.8.2-PROD</span>
    </footer>
</div>

<script src="{{ asset('js/dossier-instruction.js') }}" defer></script>
