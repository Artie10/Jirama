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
                            <span class="vr-chip">3/3 Validées</span>
                        </div>
                        <p class="vr-card__intro">
                            Contrôle de complétude juridique conforme à la norme administrative Enedis-NOI-RES_43E.
                        </p>
                        <div class="vr-docs">
                            <!-- Document 1 : Permis -->
                            <div class="vr-doc">
                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">
                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">assignment</span>
                                        </span>
                                        <div class="vr-doc__meta">
                                            <span class="vr-doc__name">Permis de Construire (PC)</span>
                                            <span class="vr-doc__sub">PC 044 035 24 K0192 • 142 m²</span>
                                            <span class="vr-doc__date">Délivré le 12/01/2025 par Mairie</span>
                                        </div>
                                    </div>
                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">check_circle</span> Conforme
                                    </span>
                                </div>
                                <div class="vr-doc__bottom">
                                    <span class="vr-doc__size">PDF • 4.2 Mo</span>
                                    <button class="vr-link-btn">
                                        <span class="material-symbols-outlined">visibility</span> Consulter l'acte
                                    </button>
                                </div>
                            </div>
                            <!-- Document 2 : Cadastre -->
                            <div class="vr-doc">
                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">
                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">map</span>
                                        </span>
                                        <div class="vr-doc__meta">
                                            <span class="vr-doc__name">Extrait Cadastral Officiel</span>
                                            <span class="vr-doc__sub">Section B, Parcelles 114 & 115</span>
                                            <span class="vr-doc__date">Échelle 1:500 • Géomètre Expert</span>
                                        </div>
                                    </div>
                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">check_circle</span> Certifié
                                    </span>
                                </div>
                                <div class="vr-doc__bottom">
                                    <span class="vr-doc__size">DWG / PDF • 8.9 Mo</span>
                                    <button class="vr-link-btn">
                                        <span class="material-symbols-outlined">visibility</span> Voir le tracé
                                    </button>
                                </div>
                            </div>
                            <!-- Document 3 : CNI -->
                            <div class="vr-doc">
                                <div class="vr-doc__top">
                                    <div class="vr-doc__left">
                                        <span class="vr-doc__icon">
                                            <span class="material-symbols-outlined">badge</span>
                                        </span>
                                        <div class="vr-doc__meta">
                                            <span class="vr-doc__name">Identité du Pétitionnaire</span>
                                            <span class="vr-doc__sub">CNI M. Marc DUPONT</span>
                                            <span class="vr-doc__date">Validité : 11/2031 • FranceConnect+</span>
                                        </div>
                                    </div>
                                    <span class="vr-badge">
                                        <span class="material-symbols-outlined">check_circle</span> Vérifié
                                    </span>
                                </div>
                                <div class="vr-doc__bottom">
                                    <span class="vr-doc__size">PDF • 1.1 Mo</span>
                                    <button class="vr-link-btn">
                                        <span class="material-symbols-outlined">visibility</span> Contrôle régalien
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- Demandeur Profile Card -->
                        <div class="vr-contact">
                            <div class="vr-contact__head">
                                <span class="material-symbols-outlined">account_box</span>
                                <span>Contact Client Privilégié</span>
                            </div>
                            <div class="vr-contact__grid">
                                <span>Téléphone :</span>
                                <span class="vr-contact__phone">06 42 19 88 00</span>
                                <span>Courriel :</span>
                                <span>m.dupont@ouest-mail.fr</span>
                                <span>Statut d'occupation :</span>
                                <span>Propriétaire Bâtisseur</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- COLONNE 2 : Relevé Maître Mesure -->
                <div class="vr-col">
                    <div class="vr-card">
                        <div class="vr-card__head">
                            <div class="vr-card__title">
                                <span class="material-symbols-outlined">straighten</span>
                                <h2>Relevé Maître Mesure</h2>
                            </div>
                            <span class="vr-chip vr-chip--ref">Réf: MM-7840</span>
                        </div>
                        <!-- Distance & Typologie -->
                        <div class="vr-metrics">
                            <div class="vr-metric">
                                <span class="vr-metric__label">Distance Réseau-Coffret</span>
                                <div class="vr-metric__value">
                                    <span class="vr-metric__num">38.5</span>
                                    <span class="vr-metric__unit">mètres</span>
                                </div>
                                <div class="vr-metric__note">
                                    <span class="vr-metric__dot"></span>
                                    <span>Dépassement seuil 30m</span>
                                </div>
                            </div>
                            <div class="vr-metric">
                                <span class="vr-metric__label">Configuration Technique</span>
                                <div class="vr-metric__value">
                                    <span class="vr-metric__num vr-metric__num--blue">Type 2</span>
                                </div>
                                <div class="vr-metric__note">Comptage en limite de propriété</div>
                            </div>
                        </div>
                        <!-- Câblage & chute de tension -->
                        <div class="vr-cable">
                            <div class="vr-cable__head">
                                <span class="vr-cable__label">Câblage Dérivé & Chute de Tension</span>
                                <span class="vr-cable__value">ΔU = 1.28% ( &lt; 2%)</span>
                            </div>
                            <div class="vr-phase-bar">
                                <div class="vr-phase vr-phase--l1" title="Phase L1 active"></div>
                                <div class="vr-phase vr-phase--reserve" title="Réserve"></div>
                                <div class="vr-phase vr-phase--security" title="Sécurité"></div>
                            </div>
                            <div class="vr-cable__foot">
                                <span>Section : 2x35 mm² Alu</span>
                                <span>Poste Source : HTA Beaujoire 04</span>
                            </div>
                        </div>
                        <!-- Photos terrain -->
                        <div class="vr-photos">
                            <div class="vr-photos__head">
                                <span class="vr-photos__title">
                                    <span class="material-symbols-outlined">photo_camera</span> Relevés Photographiques
                                    Géolocalisés
                                </span>
                                <span class="vr-photos__count">2 Clichés Certifiés</span>
                            </div>
                            <div class="vr-photos__grid">
                                <div class="vr-photo">
                                    <img data-alt="Photo technique d'un poteau béton HTA/BT avec lignes basse tension"
                                        alt="Poteau P-09 HTA/BT"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFFT0arrpQJA3SQndjPXj-9EJAARoz1UsuNCj0TknmmWNI0UicCqa97djk4C4V2RgXJwqptBpV12slu21UczhKmSM6QOvE2Pxqss547IAdcisiQW29ZE2VFyUJJ3NgOIoScyus5XLz46uT2gWUyeZLx3lxlbgcXQWRxFsW2qa1Q9N5P06PxNaxhSECgHZXu2S5FWM7xDPEBN-rmvx3CoLMacTu5gZV4DlUO82Rvs7IM5JUiVrjZs2Z" />
                                    <div class="vr-photo__shade"></div>
                                    <div class="vr-photo__cap">
                                        <span>Poteau P-09 HTA/BT</span>
                                        <span class="material-symbols-outlined">check_circle</span>
                                    </div>
                                </div>
                                <div class="vr-photo">
                                    <img data-alt="Gros plan d'un coffret de comptage en limite de propriété"
                                        alt="Coffret Borne Limite"
                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzrt4kgoTJ7cyG2z97wU6mNNgzumg4ZqUbeOXEmv3mEzGh84wdYHIfGr86-fQ3dQT7c5asB6ptk-c4P6M63kGIbqVsjomlvhpUGf_Ivm12GiJj08C3Dxa8RbNcHBT7Pgzc1wevGHZEOIK7JNwQsvn05HZ25tHqhKFITHOlm7-TxOwhhrNTwv-jdYIxkymswkerXYnXV84maxrhowcXlARnRpFNpTDTwtwjADK79_ElA0_nV8R7rFoP" />
                                    <div class="vr-photo__shade"></div>
                                    <div class="vr-photo__cap">
                                        <span>Coffret Borne Limite</span>
                                        <span class="material-symbols-outlined">check_circle</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Servitude de passage -->
                        <div class="vr-servitude">
                            <span class="vr-servitude__icon">
                                <span class="material-symbols-outlined">handshake</span>
                            </span>
                            <div class="vr-servitude__body">
                                <div class="vr-servitude__row">
                                    <span class="vr-servitude__title">Convention de Servitude</span>
                                    <span class="vr-badge">Enregistrée</span>
                                </div>
                                <p class="vr-servitude__text">
                                    Autorisation manuscrite parcelle riveraine <strong>B-114</strong> signée par les
                                    consorts Voisin, certifiée conforme par Maître Tessier (Notaire).
                                </p>
                                <div class="vr-servitude__meta">
                                    <span>Réf : SERV-2025-09</span>
                                    <span>Portée : Tranchée 0.8m</span>
                                </div>
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
                                <h2>Calculateur & Devis Réseau</h2>
                            </div>
                            <span class="vr-chip vr-chip--blue">Barème TURPE 6</span>
                        </div>
                        <p class="vr-card__intro">
                            Chiffrage automatisé conformément au catalogue des prestations Enedis en vigueur.
                        </p>
                        <div class="vr-lines">
                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Forfait branchement BT 12 kVA</span>
                                    <span class="vr-line__sub">Liaison standard réseau jusqu'à 30m</span>
                                </div>
                                <span class="vr-line__amount">950,00 €</span>
                            </div>
                            <div class="vr-line vr-line--extra">
                                <div class="vr-line__txt">
                                    <div class="vr-line__title-row">
                                        <span class="vr-line__title">Supplément distance (&gt;30m)</span>
                                        <span class="vr-dist-chip">+8.5m</span>
                                    </div>
                                    <span class="vr-line__sub">42,00 € / mètre linéaire supplémentaire</span>
                                </div>
                                <span class="vr-line__amount">357,00 €</span>
                            </div>
                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Travaux d'extension voirie</span>
                                    <span class="vr-line__sub">Fourreau TPC Ø90 + Traversée enrobé</span>
                                </div>
                                <span class="vr-line__amount">420,00 €</span>
                            </div>
                            <div class="vr-line">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Pose compteur communicant Linky</span>
                                    <span class="vr-line__sub">Module radio CPL G3 + AGCP différentiel</span>
                                </div>
                                <span class="vr-line__amount">65,00 €</span>
                            </div>
                            <div class="vr-line vr-line--deduct">
                                <div class="vr-line__txt">
                                    <span class="vr-line__title">Déduction réfection collectivités</span>
                                    <span class="vr-line__sub">Quote-part aménagement voirie communale</span>
                                </div>
                                <span class="vr-line__amount">-150,00 €</span>
                            </div>
                        </div>
                        <div class="vr-subtotals">
                            <div class="vr-subtotals__row">
                                <span>Total Forfaitaire Hors Taxes :</span>
                                <span>1 642,00 € HT</span>
                            </div>
                            <div class="vr-subtotals__row">
                                <span>TVA Applicable (20.00%) :</span>
                                <span>328,40 €</span>
                            </div>
                        </div>
                        <div class="vr-total">
                            <div class="vr-total__bar"></div>
                            <div class="vr-total__inner">
                                <div class="vr-total__head">
                                    <span class="vr-total__label">Montant Net à Payer Client</span>
                                    <span class="vr-total__status">Validé Réseau</span>
                                </div>
                                <div class="vr-total__amount">
                                    1 970,40 <span class="vr-total__cur">€ TTC</span>
                                </div>
                                <span class="vr-total__note">
                                    Acompte requis à l'acceptation : 591,12 € (30%) • Validité devis : 3 mois
                                </span>
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
