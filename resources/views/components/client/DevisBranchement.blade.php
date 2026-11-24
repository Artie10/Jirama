{{-- resources/views/components/DossierBranchement.blade.php --}}
{{-- CSS : public/css/DossierBranchement.css (à charger dans le layout : <link rel="stylesheet" href="{{ asset('css/DossierBranchement.css') }}">) --}}
@php
    // Données fictives — à remplacer par le backend ($materiels, $dossier…)
    $materiels = $materiels ?? [
        [
            'nom' => 'Bouche à clé tête ronde',
            'detail' => '1 unité par branchement',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 144370,
            'jirama' => false,
        ],
        [
            'nom' => 'Compteur d’eau',
            'detail' => 'Fourni gratuitement par la JIRAMA',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 0,
            'jirama' => true,
        ],
        [
            'nom' => 'Pose du compteur d’eau',
            'detail' => '1 pose par compteur',
            'qte' => 1,
            'unite' => 'pose',
            'pu' => 6821,
            'jirama' => false,
        ],
        [
            'nom' => 'Niche compteur classique',
            'detail' => '1 unité par compteur',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 13894,
            'jirama' => false,
        ],
        [
            'nom' => 'Coude 1/4 Galva FF 26×34',
            'detail' => 'Selon le nombre de changements de direction',
            'qte' => 0,
            'unite' => 'unité',
            'pu' => 996,
            'jirama' => false,
        ],
        [
            'nom' => 'Réduction Galva FF 26/15',
            'detail' => 'Selon le nombre de changements de diamètre',
            'qte' => 0,
            'unite' => 'unité',
            'pu' => 996,
            'jirama' => false,
        ],
        [
            'nom' => 'Robinet d’arrêt DN 15',
            'detail' => '1 unité par compteur',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 851,
            'jirama' => false,
        ],
        [
            'nom' => 'Mamelon fileté droit 15/21 Galva',
            'detail' => '1 unité par branchement',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 851,
            'jirama' => false,
        ],
        [
            'nom' => 'Colle PVC en tube 125 MG',
            'detail' => 'Fournie par la JIRAMA — aucun frais de pose facturé',
            'qte' => 1,
            'unite' => 'tube',
            'pu' => 0,
            'jirama' => true,
        ],
        [
            'nom' => 'Béton pour butée et calage',
            'detail' => '0,02 m³ par branchement',
            'qte' => 0.02,
            'unite' => 'm³',
            'pu' => 95223,
            'jirama' => false,
        ],
        [
            'nom' => 'Tuyau PVC 16 bars DN 32',
            'detail' => 'Longueur mesurée + 10 % de marge',
            'qte' => 71.5,
            'unite' => 'mètre',
            'pu' => 5278,
            'jirama' => false,
        ],
        [
            'nom' => 'Robinet PC 25',
            'detail' => '1 unité par compteur',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 6005,
            'jirama' => false,
        ],
        [
            'nom' => 'Collier GB/PVC 63',
            'detail' => '1 unité par compteur',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 5755,
            'jirama' => false,
        ],
        [
            'nom' => 'Tuyau Galva 26×34',
            'detail' => '1 unité par compteur',
            'qte' => 1,
            'unite' => 'unité',
            'pu' => 2304,
            'jirama' => false,
        ],
    ];

    $ar = fn($n) => number_format($n, 0, ',', ' ') . ' Ar';
    $qte = fn($n) => number_format($n, 2, ',', ' ');

    $lignes = collect($materiels)->map(function ($m) {
        $m['total'] = (int) round($m['qte'] * $m['pu']);
        return $m;
    });
    $totalGeneral = $lignes->sum('total');
@endphp

<div class="vb-root">

    {{-- Bandeau de statut --}}
    <div class="vb-ribbon">
        <div class="vb-ribbon-left">
            <span class="vb-badge-white">RÉGIE DES EAUX PUBLIQUES</span>
            <span class="vb-sep">•</span>
            <span class="vb-tabular vb-muted">Réf. Branchement #WTR-9942-B</span>
        </div>
        <div class="vb-ribbon-right">
            <button type="button" class="vb-btn-light" onclick="window.print()">Imprimer le dossier</button>
            <button type="button" class="vb-btn-light">Transmettre au fontainier</button>
        </div>
    </div>

    <div class="vb-content">

        {{-- Hero --}}
        <section class="vb-hero">
            <div class="vb-hero-glow vb-hero-glow-1"></div>
            <div class="vb-hero-glow vb-hero-glow-2"></div>

            <div class="vb-hero-inner">
                <div class="vb-hero-top">
                    <div class="vb-hero-title-block">
                        <span class="vb-tag">Adduction Eau Potable (AEP)</span>
                        <h1 class="vb-h1">Dossier de Branchement d'Eau Potable • EAU-2025-0419</h1>
                        <p class="vb-hero-text">
                            Raccordement d'un bâtiment individuel neuf au réseau d'adduction. Fournitures et
                            main-d'œuvre chiffrées selon le bordereau JIRAMA.
                        </p>
                    </div>

                    <div class="vb-status-card">
                        <div class="vb-status-line">
                            <span class="vb-dot-green"></span>
                            <span class="vb-status-step">Étape 4 / 6 : Éligible aux travaux</span>
                        </div>
                        <span class="vb-status-title">Dossier validé après métré terrain</span>
                        <span class="vb-status-sub">Devis émis. En attente de la signature du client.</span>
                    </div>
                </div>

                {{-- Stepper --}}
                <div class="vb-stepper">
                    @php
                        $etapes = [
                            ['1', 'Demande déposée', '14 Janvier 2025', 'done'],
                            ['2', 'Étude sur terrain', '65,00 m métrés', 'done'],
                            ['3', 'Validation admin', 'Dossier validé', 'done'],
                            ['4', 'Devis & approvisionnement', 'En cours (signature client)', 'current'],
                            ['5', 'Travaux', 'Prévu semaine 11', 'todo'],
                            ['6', 'Mise en service', 'À planifier', 'todo'],
                        ];
                    @endphp
                    @foreach ($etapes as [$num, $titre, $sous, $etat])
                        <div class="vb-step vb-step-{{ $etat }}">
                            <div class="vb-step-head">
                                <span class="vb-step-num">{{ $etat === 'done' ? '✓' : $num }}</span>
                                <span class="vb-step-title">{{ $num }}. {{ $titre }}</span>
                            </div>
                            <span class="vb-step-sub">{{ $sous }}</span>
                        </div>
                    @endforeach
                </div>

                {{-- Cartes d'infos --}}
                <div class="vb-info-grid">
                    <div class="vb-info-card">
                        <span class="vb-info-label">Demandeur principal</span>
                        <div>
                            <span class="vb-info-main">M. Karim EL AMRANI</span>
                            <span class="vb-info-sub">Titulaire de la concession</span>
                        </div>
                        <div class="vb-info-foot">
                            <span>CIN :</span>
                            <span class="vb-chip">BE •••• 9214</span>
                        </div>
                    </div>

                    <div class="vb-info-card">
                        <span class="vb-info-label">Implantation parcellaire</span>
                        <div>
                            <span class="vb-info-main">28 Rue des Sources</span>
                            <span class="vb-info-sub">Parcelle cadastrale B-204 (Secteur Nord)</span>
                        </div>
                        <div class="vb-info-foot">
                            <span>Coordonnées GPS :</span>
                            <span class="vb-tabular">43.6045° N, 3.8792° E</span>
                        </div>
                    </div>

                    <div class="vb-info-card">
                        <span class="vb-info-label">Relevé métré fontainier</span>
                        <div class="vb-metre">
                            <span class="vb-metre-value">65,00</span>
                            <span class="vb-metre-unit">mètres linéaires</span>
                        </div>
                        <div class="vb-info-foot">
                            <span>Fontainier référent :</span>
                            <span>J. Moreau (Agent #44)</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Onglets --}}
        <div class="vb-tabs">
            <div class="vb-tabs-left">
                <button type="button" class="vb-tab vb-tab-active" data-vb-tab="materiel">
                    Bordereau technique &amp; fournitures ({{ $lignes->count() }} articles)
                </button>
                <button type="button" class="vb-tab" data-vb-tab="devis">Chiffrage &amp; devis</button>
                <button type="button" class="vb-tab" data-vb-tab="implantation">Métré &amp; implantation</button>
            </div>
            <span class="vb-badge-green">Bordereau JIRAMA</span>
        </div>

        {{-- Panneau 1 : matériel --}}
        <div class="vb-panel" id="vb-panel-materiel">
            <div class="vb-callout">
                <div>
                    <h3 class="vb-h3">Bordereau technique des équipements prescrits</h3>
                    <p class="vb-body vb-muted">
                        Liste des fournitures et de la main-d'œuvre pour ce branchement. Les articles fournis par la
                        JIRAMA ne sont pas facturés.
                    </p>
                </div>
                <button type="button" class="vb-btn-gray">Télécharger la liste (PDF)</button>
            </div>

            <div class="vb-card">
                <div class="vb-card-head">
                    <div class="vb-card-head-left">
                        <span class="vb-h3 vb-primary">Bordereau détaillé des fournitures</span>
                        <span class="vb-pill">{{ $lignes->count() }} composants</span>
                    </div>
                    <span class="vb-tabular vb-muted">Montants en Ariary (Ar)</span>
                </div>

                <div class="vb-table-wrap">
                    <table class="vb-table">
                        <thead>
                            <tr>
                                <th>Désignation</th>
                                <th class="vb-center">Quantité</th>
                                <th>Statut</th>
                                <th class="vb-right">PU main-d'œuvre</th>
                                <th class="vb-right">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lignes as $i => $m)
                                <tr class="{{ $m['jirama'] ? 'vb-row-jirama' : '' }}">
                                    <td>
                                        <div class="vb-item">
                                            <span class="vb-item-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                            <div class="vb-item-text">
                                                <span class="vb-item-name">{{ $m['nom'] }}</span>
                                                <span class="vb-item-detail">{{ $m['detail'] }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="vb-center vb-tabular vb-strong">{{ $qte($m['qte']) }}
                                        {{ $m['unite'] }}</td>
                                    <td>
                                        @if ($m['jirama'])
                                            <span class="vb-status vb-status-jirama">Fourni par la JIRAMA</span>
                                        @else
                                            <span class="vb-status">À facturer</span>
                                        @endif
                                    </td>
                                    <td class="vb-right vb-tabular">{{ $ar($m['pu']) }}</td>
                                    <td
                                        class="vb-right vb-tabular vb-strong {{ $m['jirama'] ? 'vb-secondary' : 'vb-primary' }}">
                                        {{ $ar($m['total']) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="4" class="vb-right">Total général des fournitures et main-d'œuvre :</td>
                                <td class="vb-right vb-total">{{ $ar($totalGeneral) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        {{-- Panneau 2 : devis --}}
        <div class="vb-panel vb-hidden" id="vb-panel-devis">
            <div class="vb-card vb-card-pad">
                <span class="vb-label-accent">Chiffrage</span>
                <h3 class="vb-h3 vb-primary">Récapitulatif du devis</h3>
                <div class="vb-recap">
                    <div class="vb-recap-row"><span>Nombre d'articles</span><span
                            class="vb-tabular">{{ $lignes->count() }}</span></div>
                    <div class="vb-recap-row"><span>Articles fournis par la JIRAMA</span><span
                            class="vb-tabular">{{ $lignes->where('jirama', true)->count() }}</span></div>
                    <div class="vb-recap-row vb-recap-total"><span>Total à payer</span><span
                            class="vb-tabular">{{ $ar($totalGeneral) }}</span></div>
                </div>
            </div>
        </div>

        {{-- Panneau 3 : implantation --}}
        <div class="vb-panel vb-hidden" id="vb-panel-implantation">
            <div class="vb-impl-grid">
                <div class="vb-card vb-card-pad">
                    <div class="vb-impl-head">
                        <div>
                            <span class="vb-label-accent">Métré &amp; tracé technique</span>
                            <h3 class="vb-h3 vb-primary">Coupe du tracé d'adduction (65,00 m)</h3>
                        </div>
                        <span class="vb-badge-gray">Visite effectuée le 22/01/2025</span>
                    </div>

                    <div class="vb-schema">
                        <div class="vb-schema-grid"></div>
                        <div class="vb-schema-legend">
                            <span class="vb-legend"><i class="vb-legend-dot vb-legend-blue"></i>Canalisation
                                principale (domaine public)</span>
                            <span class="vb-legend"><i class="vb-legend-dot vb-legend-orange"></i>Niche compteur
                                (limite de propriété)</span>
                        </div>
                        <svg class="vb-schema-svg" viewBox="0 0 700 120" fill="none">
                            <circle cx="50" cy="60" r="28" fill="#0066FF" opacity="0.3"
                                stroke="#0066FF" stroke-width="3" />
                            <circle cx="50" cy="60" r="16" fill="#0066FF" />
                            <text x="50" y="106" fill="#93C5FD" font-size="10" text-anchor="middle">CONDUITE</text>
                            <rect x="78" y="52" width="18" height="16" rx="2" fill="#F87171" />
                            <path d="M 96 60 L 590 60" stroke="#0266FF" stroke-width="8" stroke-dasharray="12 4" />
                            <path d="M 96 60 L 590 60" stroke="#60A5FA" stroke-width="2" />
                            <line x1="100" y1="28" x2="586" y2="28" stroke="#F85200"
                                stroke-width="2" />
                            <rect x="300" y="16" width="100" height="22" rx="4" fill="#1E293B"
                                stroke="#F85200" />
                            <text x="350" y="31" fill="#FFFFFF" font-size="11" font-weight="bold"
                                text-anchor="middle">65,00 MÈTRES</text>
                            <rect x="590" y="30" width="60" height="60" rx="4" fill="#0284C7"
                                opacity="0.4" stroke="#0284C7" stroke-width="2" />
                            <circle cx="620" cy="60" r="12" fill="#FFFFFF" />
                            <text x="620" y="106" fill="#93C5FD" font-size="10" text-anchor="middle">NICHE</text>
                        </svg>
                        <div class="vb-schema-foot">
                            <span>Tuyau PVC 16 bars DN 32</span>
                            <span>Marge de 10 % incluse</span>
                        </div>
                    </div>

                    <div class="vb-note">
                        <span class="vb-note-title">Observations fontainier sur place (Agent Moreau) :</span>
                        <p class="vb-body vb-muted">
                            « Accès dégagé. Aucun réseau à proximité immédiate du tracé. Prévoir une coupe nette pour
                            préserver le revêtement de voirie. »
                        </p>
                    </div>
                </div>

                <div class="vb-side">
                    <div class="vb-card vb-card-pad vb-inspector">
                        <div class="vb-avatar">JM</div>
                        <div class="vb-inspector-text">
                            <span class="vb-label-gray">Maître-fontainier</span>
                            <span class="vb-h3 vb-primary">Julien MOREAU</span>
                            <span class="vb-small vb-muted">Direction Réseaux &amp; Travaux Sud</span>
                            <span class="vb-tabular vb-secondary">Tél : 04 67 00 12 44</span>
                        </div>
                    </div>

                    <div class="vb-card vb-card-pad">
                        <span class="vb-label-md">Données hydro-cadastrales</span>
                        <div class="vb-kv"><span>Régime de distribution :</span><span class="vb-tabular">Gravitaire
                                régulé</span></div>
                        <div class="vb-kv"><span>Dureté de l'eau (TH) :</span><span class="vb-tabular">18,2 °f</span>
                        </div>
                        <div class="vb-kv"><span>Chlore libre :</span><span class="vb-tabular">0,25 mg/L</span></div>
                        <div class="vb-kv"><span>Concession d'eau :</span><span class="vb-tabular">Bassin
                                Méditerranéen</span></div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    (function() {
        var root = document.currentScript.previousElementSibling;
        if (!root) return;
        var tabs = root.querySelectorAll('[data-vb-tab]');
        tabs.forEach(function(btn) {
            btn.addEventListener('click', function() {
                var key = btn.getAttribute('data-vb-tab');
                tabs.forEach(function(b) {
                    var actif = b === btn;
                    b.classList.toggle('vb-tab-active', actif);
                    root.querySelector('#vb-panel-' + b.getAttribute('data-vb-tab'))
                        .classList.toggle('vb-hidden', !actif);
                });
            });
        });
    })();
</script>
