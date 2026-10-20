{{-- resources/views/components/volta/dossiers.blade.php --}}
@props([
    'userName' => 'Ing. Sarah Laurent',
    'userRole' => 'Pôle Raccordement',
    'waitingCount' => 7,
    'urgentCount' => 2,
    'averageDelay' => '3,8 j ouvrés',
    'dossiers' => null,
    'selectedDossier' => null,
])

@php
    $dossiers = $dossiers ?? [
        [
            'reference' => 'RAC-2025-0842', 'priority' => 'Priorité J-4',
            'name' => 'M. Marc DUPONT',
            'address' => '14 Bis Chemin des Hautes Terres, 44240 La Chapelle-sur-Erdre',
            'power' => '12 kVA Mono', 'type' => 'Type 2 (Long.)',
            'date' => '18 Fév. 2025 à 09:14',
            'delay' => 'Il y a 6j (Délai légal J-4)',
            'status' => 'Étude terrain validée (38.5m) • Prêt pour instruction et devis',
            'cadastre' => 'B-114', 'enedis' => 'AR-44-902', 'active' => true,
        ],
        [
            'reference' => 'RAC-2025-0845', 'priority' => 'Échéance J-5',
            'name' => 'Mme Valérie MOREAU',
            'address' => '3 Rue des Chênes Verts, 44000 Nantes',
            'power' => '36 kVA Tri', 'type' => 'Type 1 (Direct)',
            'date' => '19 Fév. 2025 à 14:30', 'delay' => '',
            'status' => 'Relevé terrain en attente', 'cadastre' => '', 'enedis' => '', 'active' => false,
        ],
        [
            'reference' => 'RAC-2025-0849', 'priority' => 'Servitude requise',
            'name' => 'SCI Les Oliviers (M. B. Lambert)',
            'address' => "Parc d'Activité de l'Estuaire, Saint-Nazaire",
            'power' => '18 kVA Tri', 'type' => 'Pro / Tertiaire',
            'date' => '20 Fév. 2025 à 11:05', 'delay' => '',
            'status' => 'Étude maître mesure déposée', 'cadastre' => '', 'enedis' => '', 'active' => false,
        ],
        [
            'reference' => 'RAC-2025-0852', 'priority' => 'Conforme',
            'name' => 'M. Thomas LECLERC',
            'address' => '8 Impasse des Marais, 44300 Nantes',
            'power' => '9 kVA Mono', 'type' => 'Résidentiel individuel',
            'date' => '21 Fév. 2025 à 16:45', 'delay' => '',
            'status' => 'Dossier complet • En file', 'cadastre' => '', 'enedis' => '', 'active' => false,
        ],
    ];

    $selectedDossier = $selectedDossier ?? $dossiers[0];
@endphp

@once
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Plus+Jakarta+Sans:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/tableauxDeBordAdmin.css') }}">
@endonce

<div class="vr-dashboard">
    <aside class="vr-sidebar">
        <div>
            <div class="vr-brand">
                <div class="vr-brand-mark">V<span>R</span></div>
                <div>
                    <strong>VoltaRéseau</strong>
                    <small>Poste d'Instruction</small>
                </div>
            </div>
            <div class="vr-sidebar-label"><span class="vr-dot"></span> Portail Ingénierie &amp; Admin</div>
        </div>

        <div class="vr-user">
            <div class="vr-avatar">SL</div>
            <div class="vr-user-info">
                <strong>{{ $userName }}</strong>
                <small>{{ $userRole }}</small>
            </div>
            <a href="{{ url('/logout') }}" class="vr-logout" aria-label="Se déconnecter" title="Se déconnecter">
                <span class="material-symbols-outlined">power_settings_new</span>
            </a>
        </div>
    </aside>

    <div class="vr-main">
        <header class="vr-topbar">
            <div class="vr-sync"><span class="vr-dot"></span> Réseau national • Synchronisé</div>
            <button class="vr-icon-button" type="button" aria-label="Notifications">
                <span class="material-symbols-outlined">notifications</span>
            </button>
        </header>

        <main class="vr-content">
            <section class="vr-page-heading">
                <div class="vr-heading-copy">
                    <div class="vr-title-line">
                        <h1>Gestion des dossiers de raccordement</h1>
                        <span class="vr-badge vr-badge-blue"><span class="vr-dot"></span>{{ $waitingCount }} dossiers en attente</span>
                        <span class="vr-badge vr-badge-neutral"><span class="material-symbols-outlined">bolt</span> BT Inf 36 kVA &amp; HTA</span>
                    </div>
                    <p>Ordonnancement technique et pré-qualification administrative des dossiers de raccordement.</p>
                </div>

                <div class="vr-metrics">
                    <article class="vr-metric">
                        <div class="vr-metric-icon vr-icon-orange"><span class="material-symbols-outlined">timer</span></div>
                        <div><small>Échéances critiques</small><strong>{{ $urgentCount }} sous J-2</strong></div>
                    </article>
                    <article class="vr-metric">
                        <div class="vr-metric-icon vr-icon-blue"><span class="material-symbols-outlined">rule</span></div>
                        <div><small>Moy. prise en charge</small><strong>{{ $averageDelay }}</strong></div>
                    </article>
                </div>
            </section>

            <form class="vr-toolbar" method="GET" action="{{ url()->current() }}">
                <label class="vr-search">
                    <span class="material-symbols-outlined">search</span>
                    <input type="search" name="q" value="{{ request('q') }}" placeholder="Rechercher un numéro, un client, une commune…">
                </label>
                <div class="vr-toolbar-actions">
                    <span class="vr-sort"><span class="material-symbols-outlined">schedule</span> Tri chronologique : plus ancien en premier</span>
                    <button type="button" class="vr-button vr-button-light"><span class="material-symbols-outlined">tune</span> Colonnes &amp; réseau</button>
                </div>
            </form>

            <nav class="vr-filters" aria-label="Filtres des dossiers">
                <a href="{{ url()->current() }}" class="vr-filter is-active">Tous les dossiers <span>{{ $waitingCount }}</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statut' => 'urgent']) }}" class="vr-filter"><span class="material-symbols-outlined">emergency</span> Urgents <span>{{ $urgentCount }}</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statut' => 'mesure']) }}" class="vr-filter"><span class="material-symbols-outlined">assignment_turned_in</span> Mesure reçue <span>4</span></a>
                <a href="{{ request()->fullUrlWithQuery(['statut' => 'pieces']) }}" class="vr-filter"><span class="material-symbols-outlined">pending_actions</span> Pièces client en attente <span>1</span></a>
            </nav>

            <div class="vr-workspace">
                <section class="vr-queue">
                    <div class="vr-section-heading">
                        <strong>Dépôts réseau • Ordre d'arrivée</strong>
                        <span>Affichage 1-{{ count($dossiers) }} sur {{ $waitingCount }}</span>
                    </div>

                    <div class="vr-dossier-list">
                        @foreach ($dossiers as $dossier)
                            <article class="vr-dossier-card {{ !empty($dossier['active']) ? 'is-selected' : '' }}">
                                @if (!empty($dossier['active']))
                                    <div class="vr-card-banner">
                                        <strong>{{ $dossier['reference'] }}</strong>
                                        <span class="vr-priority">{{ $dossier['priority'] }}</span>
                                        <span class="vr-selected-label"><span class="material-symbols-outlined">fingerprint</span> Sélection active</span>
                                    </div>
                                @endif
                                <div class="vr-card-body">
                                    <div class="vr-card-main">
                                        <div class="vr-card-person">
                                            @if (empty($dossier['active']))
                                                <div class="vr-card-reference">{{ $dossier['reference'] }} <span class="vr-priority vr-priority-light">{{ $dossier['priority'] }}</span></div>
                                            @endif
                                            <h3>{{ $dossier['name'] }}</h3>
                                            <p><span class="material-symbols-outlined">location_on</span>{{ $dossier['address'] }}</p>
                                        </div>
                                        <div class="vr-power">
                                            <strong>{{ $dossier['power'] }}</strong>
                                            <small>{{ $dossier['type'] }}</small>
                                        </div>
                                    </div>
                                    <div class="vr-date-row">
                                        <span><span class="material-symbols-outlined">event</span>{{ $dossier['date'] }}</span>
                                        @if (!empty($dossier['delay']))
                                            <span class="vr-danger"><span class="material-symbols-outlined">warning</span>{{ $dossier['delay'] }}</span>
                                        @else
                                            <span class="vr-status">{{ $dossier['status'] }}</span>
                                        @endif
                                    </div>
                                    @if (!empty($dossier['active']))
                                        <div class="vr-progress-copy"><span class="vr-dot"></span>{{ $dossier['status'] }}</div>
                                        <div class="vr-progress"><span></span></div>
                                        <div class="vr-card-footer">
                                            <div class="vr-tags"><span>Cadastre : {{ $dossier['cadastre'] }}</span><span>Réf. réseau : {{ $dossier['enedis'] }}</span></div>
                                            <a href="#vr-detail">Voir la synthèse <span class="material-symbols-outlined">arrow_forward</span></a>
                                        </div>
                                    @endif
                                </div>
                            </article>
                        @endforeach
                    </div>

                    <div class="vr-pagination">
                        <button type="button" disabled>Précédent</button>
                        <span>Page 1 sur 2</span>
                        <button type="button">Suivant <span class="material-symbols-outlined">chevron_right</span></button>
                    </div>
                </section>

                <section class="vr-details" id="vr-detail">
                    <div class="vr-detail-hero">
                        <div class="vr-detail-hero-copy">
                            <div class="vr-hero-meta"><span>Dossier en cours de consultation</span><small>Poste source : Beaujoire HTA-04</small></div>
                            <h2>Tableau de bord dossier #{{ $selectedDossier['reference'] ?? 'RAC-2025-0842' }}</h2>
                            <p>Affecté à l'instructrice principale {{ $userName }} • Contrôle d'éligibilité prêt</p>
                        </div>
                        <button type="button" class="vr-button vr-button-orange"><span class="material-symbols-outlined">engineering</span> Commencer l'instruction <span class="material-symbols-outlined">arrow_forward</span></button>
                    </div>

                    <article class="vr-note">
                        <div class="vr-note-icon"><span class="material-symbols-outlined">quick_reference</span></div>
                        <div><strong>Note de pré-qualification <small>• 19 Fév. à 10:20</small></strong>
                            <p>« Dossier prioritaire avec servitude mitoyenne déjà transmise par le maître mesure. Tracé linéaire dégagé. Prêt pour chiffrage définitif et émission du devis. »</p>
                        </div>
                    </article>

                    <div class="vr-identity-grid">
                        <article class="vr-panel vr-contact-panel">
                            <div class="vr-panel-heading"><strong>Pétitionnaire &amp; contact</strong><span class="vr-badge vr-badge-blue">✓ Vérifié</span></div>
                            <div class="vr-contact">
                                <div class="vr-avatar vr-avatar-large">MD</div>
                                <div><h3>{{ $selectedDossier['name'] ?? 'M. Marc DUPONT' }}</h3><p>Particulier • Propriétaire occupant</p><small>client@example.com • +261 00 00 000 00</small></div>
                            </div>
                            <div class="vr-specs">
                                <div><small>Puissance souscrite</small><strong>12 kVA</strong><span>Monophasé 60A</span></div>
                                <div><small>Type raccordement</small><strong>Type 2</strong><span>Plus de 30 mètres</span></div>
                                <div><small>Usage initial</small><strong>Maison neuve</strong><span>Résidentiel</span></div>
                            </div>
                        </article>

                        <article class="vr-panel vr-location-panel">
                            <div class="vr-panel-heading"><strong>Implantation &amp; cadastre</strong><span class="vr-mini-label">Section B • Parcelles 114/115</span></div>
                            <div class="vr-map">
                                <div class="vr-map-top"><span>Repérage technique</span><span>Poste réseau à 240 m</span></div>
                                <svg viewBox="0 0 300 86" role="img" aria-label="Schéma du raccordement">
                                    <rect x="0" y="34" width="300" height="18" rx="2" fill="#d9dee7"/>
                                    <path d="M0 43 H300" stroke="#fff" stroke-width="2" stroke-dasharray="7 5"/>
                                    <rect x="46" y="15" width="13" height="13" rx="2" fill="#1769d2"/>
                                    <path d="M52 28 V62 H220" fill="none" stroke="#f47b20" stroke-width="3"/>
                                    <rect x="214" y="55" width="15" height="15" rx="2" fill="#f47b20"/>
                                    <text x="38" y="11" font-size="9" fill="#102b4e">RE-01</text>
                                    <text x="233" y="66" font-size="9" fill="#f47b20">C200</text>
                                </svg>
                                <div class="vr-map-legend"><span>Réseau : BT souterrain</span><strong>Domaine public → privé</strong></div>
                            </div>
                            <div class="vr-location-footer"><span>Commune : La Chapelle-sur-Erdre</span><a href="#vr-detail">Voir le plan <span class="material-symbols-outlined">open_in_new</span></a></div>
                        </article>
                    </div>

                    <div class="vr-three-panels">
                        <article class="vr-panel vr-info-panel">
                            <div class="vr-panel-heading"><strong>1. Pièces du dossier</strong><span class="vr-state-good">3/3 conformes</span></div>
                            <ul class="vr-check-list"><li>Permis de construire <b>Validé</b></li><li>Extrait cadastral <b>Validé</b></li><li>Pièce d'identité <b>Conforme</b></li></ul>
                            <button type="button" class="vr-button vr-button-light vr-full-button"><span class="material-symbols-outlined">visibility</span> Consulter les pièces</button>
                        </article>
                        <article class="vr-panel vr-info-panel">
                            <div class="vr-panel-heading"><strong>2. Relevé terrain</strong><span class="vr-state-good">Signé technicien</span></div>
                            <ul class="vr-data-list"><li><span>Métré linéaire total</span><b>38,5 m</b></li><li><span>Section câble</span><b>4x35 mm² Alu</b></li><li><span>Passage domaine tiers</span><b>Convention signée</b></li></ul>
                            <button type="button" class="vr-button vr-button-light vr-full-button"><span class="material-symbols-outlined">straighten</span> Fiche technique terrain</button>
                        </article>
                        <article class="vr-panel vr-info-panel">
                            <div class="vr-panel-heading"><strong>3. Pré-estimation</strong><span class="vr-mini-label">Barème 2025</span></div>
                            <div class="vr-price"><small>Montant indicatif TTC</small><strong>1 970,40 €</strong></div>
                            <ul class="vr-data-list"><li><span>Part branchement</span><b>1 420,00 €</b></li><li><span>Coffret réseau</span><b>550,40 €</b></li></ul>
                            <button type="button" class="vr-button vr-button-blue vr-full-button"><span class="material-symbols-outlined">calculate</span> Ajuster le chiffrage</button>
                        </article>
                    </div>

                    <article class="vr-panel vr-timeline">
                        <div class="vr-panel-heading"><strong><span class="material-symbols-outlined">hourglass_bottom</span> Échéancier &amp; jalons d'instruction</strong><span class="vr-deadline">Date limite du devis : 28 février</span></div>
                        <div class="vr-steps">
                            <div class="vr-step is-done"><strong>1. Dépôt initial</strong><span>18/02/2025 à 09:14</span><small>Complet et certifié</small></div>
                            <div class="vr-step is-done"><strong>2. Relevé terrain</strong><span>21/02/2025 à 15:30</span><small>Distance validée</small></div>
                            <div class="vr-step is-current"><strong>3. Instruction &amp; devis</strong><span>En cours</span><small>{{ $userName }}</small></div>
                            <div class="vr-step"><strong>4. Envoi proposition</strong><span>En attente</span><small>Après calcul</small></div>
                        </div>
                    </article>
                </section>
            </div>
        </main>

        <footer class="vr-footer"><span>Plateforme VoltaRéseau • Direction technique de distribution</span><span>Version 1.0</span></footer>
    </div>
</div>
