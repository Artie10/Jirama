
@php
    // On conserve les vrais objets Eloquent provenant de la base.
    $selectedDossier = $selectedDossier ?? $dossiers->first();
@endphp

@once
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/tableauxDeBordAdmin.css') }}">
@endonce

<div class="vr-dashboard">

    {{-- SIDEBAR --}}
    <aside class="vr-sidebar">

        <div>
            <div class="vr-brand">
                <div class="vr-brand-mark">V<span>R</span></div>

                <div>
                    <strong>VoltaRéseau</strong>
                    <small>Poste d'Instruction</small>
                </div>
            </div>

            <div class="vr-sidebar-label">
                <span class="vr-dot"></span>
                Portail Ingénierie &amp; Admin
            </div>
        </div>

        {{-- UTILISATEUR CONNECTÉ --}}
        <div class="vr-user">

            <div class="vr-avatar">
                {{ strtoupper(substr($userName, 0, 2)) }}
            </div>

            <div class="vr-user-info">
                <strong>{{ $userName }}</strong>
                <small>{{ $userRole }}</small>
            </div>

            <form method="POST" action="{{ url('/logout') }}">
                @csrf

                <button
                    type="submit"
                    class="vr-logout"
                    aria-label="Se déconnecter"
                    title="Se déconnecter"
                >
                    <span class="material-symbols-outlined">
                        power_settings_new
                    </span>
                </button>
            </form>

        </div>

    </aside>


    {{-- CONTENU PRINCIPAL --}}
    <div class="vr-main">

        {{-- TOPBAR --}}
        <header class="vr-topbar">

            <div class="vr-sync">
                <span class="vr-dot"></span>
                Réseau national • Synchronisé
            </div>

            <button class="vr-icon-button" type="button" aria-label="Notifications">
                <span class="material-symbols-outlined">
                    notifications
                </span>
            </button>

        </header>


        <main class="vr-content">

            {{-- TITRE DE LA PAGE --}}
            <section class="vr-page-heading">

                <div class="vr-heading-copy">

                    <div class="vr-title-line">

                        <h1>Gestion des dossiers de raccordement</h1>

                        <span class="vr-badge vr-badge-blue">
                            <span class="vr-dot"></span>
                            {{ $dossiers->total() }} dossiers enregistrés
                        </span>

                    </div>

                    <p>
                        Consultation et traitement administratif des demandes de branchement.
                    </p>

                </div>

            </section>


            {{-- RECHERCHE --}}
            <form class="vr-toolbar" method="GET" action="{{ url()->current() }}">

                <label class="vr-search">

                    <span class="material-symbols-outlined">
                        search
                    </span>

                    <input
                        type="search"
                        name="q"
                        value="{{ request('q') }}"
                        placeholder="Rechercher un numéro, un client ou un e-mail..."
                    >

                </label>

                <div class="vr-toolbar-actions">

                    <span class="vr-sort">
                        <span class="material-symbols-outlined">
                            schedule
                        </span>

                        Tri chronologique : plus ancien en premier
                    </span>

                    <button type="submit" class="vr-button vr-button-light">

                        <span class="material-symbols-outlined">
                            search
                        </span>

                        Rechercher

                    </button>

                </div>

            </form>


            {{-- ESPACE DE TRAVAIL --}}
            <div class="vr-workspace">


                {{-- LISTE DES DOSSIERS --}}
                <section class="vr-queue">

                    <div class="vr-section-heading">

                        <strong>Dépôts réseau • Ordre d'arrivée</strong>

                        <span>
                            Affichage
                            {{ $dossiers->firstItem() ?? 0 }}-{{ $dossiers->lastItem() ?? 0 }}
                            sur {{ $dossiers->total() }}
                        </span>

                    </div>


                    <div class="vr-dossier-list">

                        @forelse ($dossiers as $dossier)

                            <article class="vr-dossier-card {{ $selectedDossier && $selectedDossier->id === $dossier->id ? 'is-selected' : '' }}">

                                @if ($selectedDossier && $selectedDossier->id === $dossier->id)

                                    <div class="vr-card-banner">

                                        <strong>
                                            {{ $dossier->NumDossier }}
                                        </strong>

                                        <span class="vr-selected-label">

                                            <span class="material-symbols-outlined">
                                                fingerprint
                                            </span>

                                            Sélection active

                                        </span>

                                    </div>

                                @endif


                                <div class="vr-card-body">

                                    <div class="vr-card-main">

                                        <div class="vr-card-person">

                                            @if (!$selectedDossier || $selectedDossier->id !== $dossier->id)

                                                <div class="vr-card-reference">
                                                    {{ $dossier->NumDossier }}
                                                </div>

                                            @endif

                                            <h3>{{ $dossier->Nom }}</h3>

                                            <p>
                                                <span class="material-symbols-outlined">
                                                    mail
                                                </span>

                                                {{ $dossier->Mail }}
                                            </p>

                                            <p>
                                                <span class="material-symbols-outlined">
                                                    call
                                                </span>

                                                {{ $dossier->telephone }}
                                            </p>

                                        </div>


                                        <div class="vr-power">

                                            <strong>En attente</strong>

                                            <small>
                                                Longueur à mesurer
                                            </small>

                                        </div>

                                    </div>


                                    <div class="vr-date-row">

                                        <span>
                                            <span class="material-symbols-outlined">
                                                event
                                            </span>

                                            {{ $dossier->created_at?->format('d/m/Y H:i') }}
                                        </span>

                                        <span class="vr-status">
                                            {{ $dossier->statut }}
                                        </span>

                                    </div>


                                    <div class="vr-card-footer">

                                        <div class="vr-tags">
                                            <span>
                                                CIN : {{ $dossier->Cin }}
                                            </span>
                                        </div>

                                        <a href="#vr-detail">
                                            Voir la synthèse

                                            <span class="material-symbols-outlined">
                                                arrow_forward
                                            </span>
                                        </a>

                                    </div>

                                </div>

                            </article>

                        @empty

                            <p>Aucun dossier trouvé.</p>

                        @endforelse

                    </div>


                    {{-- PAGINATION --}}
                    <div class="vr-pagination">
                        {{ $dossiers->links() }}
                    </div>

                </section>



                {{-- DETAILS DU DOSSIER --}}
                <section class="vr-details" id="vr-detail">

                    @if ($selectedDossier)


                        {{-- EN-TÊTE DU DOSSIER --}}
                        <div class="vr-detail-hero">

                            <div class="vr-detail-hero-copy">

                                <div class="vr-hero-meta">
                                    <span>Dossier en cours de consultation</span>
                                </div>

                                <h2>
                                    {{ $selectedDossier->Nom }} - {{ $selectedDossier->NumDossier }}
                                </h2>

                                <p>
                                    Dossier déposé le
                                    {{ $selectedDossier->created_at?->format('d/m/Y à H:i') }}
                                </p>

                            </div>


                            {{-- BOUTON COMMENCER L'INSTRUCTION --}}
                            <button type="button" class="vr-button vr-button-blue">

                                <span class="material-symbols-outlined">
                                    engineering
                                </span>

                                Commencer l'instruction

                                <span class="material-symbols-outlined">
                                    arrow_forward
                                </span>

                            </button>

                        </div>



                        {{-- INFORMATIONS CLIENT ET IMPLANTATION --}}
                        <div class="vr-identity-grid">


                            {{-- INFORMATIONS DU CLIENT --}}
                            <article class="vr-panel vr-contact-panel">

                                <div class="vr-panel-heading">

                                    <strong>Pétitionnaire &amp; contact</strong>

                                    <span class="vr-badge vr-badge-blue">
                                        {{ $selectedDossier->statut }}
                                    </span>

                                </div>


                                <div class="vr-contact">

                                    <div class="vr-avatar vr-avatar-large">
                                        {{ strtoupper(substr($selectedDossier->Nom, 0, 2)) }}
                                    </div>

                                    <div>
                                        <h3>{{ $selectedDossier->Nom }}</h3>

                                        <p>{{ $selectedDossier->Mail }}</p>

                                        <small>
                                            {{ $selectedDossier->telephone }}
                                        </small>
                                    </div>

                                </div>


                                <div class="vr-specs">

                                    <div>
                                        <small>Numéro de dossier</small>
                                        <strong>{{ $selectedDossier->NumDossier }}</strong>
                                    </div>

                                    <div>
                                        <small>Numéro CIN</small>
                                        <strong>{{ $selectedDossier->Cin }}</strong>
                                    </div>

                                    <div>
                                        <small>Date de dépôt</small>
                                        <strong>
                                            {{ $selectedDossier->created_at?->format('d/m/Y') }}
                                        </strong>
                                    </div>

                                </div>

                            </article>



                            {{-- IMPLANTATION ET CADASTRE --}}
                            <article class="vr-panel vr-location-panel">

                                <div class="vr-panel-heading">

                                    <strong>Implantation &amp; cadastre</strong>

                                    <span class="vr-mini-label">
                                        Informations à compléter
                                    </span>

                                </div>


                                {{-- FUTURE CARTE GOOGLE MAPS --}}
                                <div class="vr-map">

                                    <div class="vr-map-top">
                                        <span>Repérage technique</span>
                                        <span>En attente du maître mesure</span>
                                    </div>


                                    <div style="min-height: 86px; display:flex; align-items:center; justify-content:center; text-align:center;">

                                        <p>
                                            <span class="material-symbols-outlined">
                                                location_on
                                            </span>

                                            <br>

                                            Le plan d'implantation sera disponible après le relevé terrain.
                                        </p>

                                    </div>


                                    <div class="vr-map-legend">

                                        <span>
                                            Localisation : non renseignée
                                        </span>

                                        <strong>
                                            En attente
                                        </strong>

                                    </div>

                                </div>


                                <div class="vr-location-footer">

                                    <span>
                                        Cadastre : en attente de vérification
                                    </span>

                                    <span>
                                        Google Maps sera intégré ultérieurement
                                    </span>

                                </div>

                            </article>

                        </div>



                        {{-- DOCUMENTS, MESURES ET AUTORISATION --}}
                        <div class="vr-three-panels">


                            {{-- PIÈCES DU DOSSIER --}}
                            <article class="vr-panel vr-info-panel">

                                <div class="vr-panel-heading">
                                    <strong>1. Pièces du dossier</strong>
                                </div>


                                <ul class="vr-check-list">

                                    <li>
                                        Demande de branchement

                                        @if ($selectedDossier->Dmd_img)

                                            <a
                                                href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($selectedDossier->Dmd_img) }}"
                                                target="_blank"
                                                rel="noopener"
                                            >
                                                Consulter
                                            </a>

                                        @else

                                            <b>Non fournie</b>

                                        @endif

                                    </li>


                                    <li>
                                        Justificatif de résidence

                                        @if ($selectedDossier->residence_img)

                                            <a
                                                href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($selectedDossier->residence_img) }}"
                                                target="_blank"
                                                rel="noopener"
                                            >
                                                Consulter
                                            </a>

                                        @else

                                            <b>Non fourni</b>

                                        @endif

                                    </li>


                                    <li>
                                        Autorisation

                                        @if ($selectedDossier->autorisation_img)

                                            <a
                                                href="{{ \Illuminate\Support\Facades\Storage::disk('public')->url($selectedDossier->autorisation_img) }}"
                                                target="_blank"
                                                rel="noopener"
                                            >
                                                Consulter
                                            </a>

                                        @else

                                            <b>Non fournie</b>

                                        @endif

                                    </li>

                                </ul>

                            </article>



                            {{-- RELEVÉ TERRAIN --}}
                            <article class="vr-panel vr-info-panel">

                                <div class="vr-panel-heading">

                                    <strong>2. Relevé terrain</strong>

                                    <span class="vr-mini-label">
                                        En attente
                                    </span>

                                </div>


                                <ul class="vr-data-list">

                                    <li>
                                        <span>Longueur du branchement</span>

                                        <b>En attente de mesure</b>
                                    </li>

                                </ul>

                            </article>



                            {{-- ÉTUDE DE L'AUTORISATION --}}
                            <article class="vr-panel vr-info-panel">

                                <div class="vr-panel-heading">

                                    <strong>3. Étude de l'autorisation</strong>

                                    <span class="vr-mini-label">
                                        En attente
                                    </span>

                                </div>


                                <ul class="vr-data-list">

                                    <li>
                                        <span>État de l'étude sur terrain</span>

                                        <b>En attente d'étude sur terrain</b>
                                    </li>

                                </ul>

                            </article>


                        </div>


                    @else

                        <p>Aucun dossier disponible pour le moment.</p>

                    @endif

                </section>

            </div>

        </main>


        {{-- FOOTER --}}
        <footer class="vr-footer">

            <span>
                Plateforme VoltaRéseau • Direction technique de distribution
            </span>

            <span>
                Version 1.0
            </span>

        </footer>

    </div>

</div>
