{{-- resources/views/components/DossierBranchement.blade.php --}}
{{-- CSS : public/css/DossierBranchement.css (à charger dans le layout : <link rel="stylesheet" href="{{ asset('css/DossierBranchement.css') }}">) --}}

@props(['client', 'mesure' => null])

@php
    // Vérifier si une mesure de terrain existe
    $mesureDisponible = $mesure !== null;

    // Informations du dossier
    $numeroDossier = $client->NumDossier ?? 'Non renseigné';
    $nomClient = $client->Nom ?? 'Non renseigné';
    $cinClient = $client->Cin ?? 'Non renseigné';
    $dateDemande = $client->created_at ? $client->created_at->format('d/m/Y') : 'Non renseignée';

    // Informations de la mesure
    $longueur = $mesureDisponible ? (float) ($mesure->longueur ?? 0) : 0;

    $dateMesure =
        $mesureDisponible && $mesure->date ? \Carbon\Carbon::parse($mesure->date)->format('d/m/Y') : 'En attente';

    $latitude = $mesureDisponible ? $mesure->latitude : null;
    $longitude = $mesureDisponible ? $mesure->longitude : null;

    $adresse = $mesureDisponible ? $mesure->adresse_localisation ?? 'Non renseignée' : 'En attente de mesure';

    $nombreDirections = $mesureDisponible ? (int) ($mesure->nombre_changements_direction ?? 0) : 0;

    $nombreDiametres = $mesureDisponible ? (int) ($mesure->nombre_changements_diametre ?? 0) : 0;

    $autorisation = $mesureDisponible ? $mesure->autorisation ?? 'En attente' : 'En attente de mesure';

    // Devis disponible uniquement après réalisation de la mesure
    $devisDisponible = $mesureDisponible && $longueur > 0;

    // Formatage des montants
    $ar = fn($montant) => number_format((float) $montant, 0, ',', ' ') . ' Ar';

    $qte = fn($quantite) => number_format((float) $quantite, 2, ',', ' ');

    // Bordereau de main-d'œuvre
    $materiels = [];

    if ($devisDisponible) {
        $materiels = [
            [
                'nom' => 'Bouche à clé tête ronde',
                'detail' => '1 unité par branchement',
                'qte' => 1,
                'unite' => 'unité',
                'pu' => 144370,
                'jirama' => false,
            ],
            [
                'nom' => 'Pose du compteur d’eau',
                'detail' => 'Main-d’œuvre de pose',
                'qte' => 1,
                'unite' => 'unité',
                'pu' => 6821,
                'jirama' => false,
            ],
            [
                'nom' => 'Niche compteur classique',
                'detail' => '1 niche par compteur',
                'qte' => 1,
                'unite' => 'unité',
                'pu' => 13894,
                'jirama' => false,
            ],
            [
                'nom' => 'Coude 1/4 Galva FF 26×34',
                'detail' => 'Selon les changements de direction relevés',
                'qte' => $nombreDirections,
                'unite' => 'unité',
                'pu' => 996,
                'jirama' => false,
            ],
            [
                'nom' => 'Réduction Galva FF 26/15',
                'detail' => 'Selon les changements de diamètre relevés',
                'qte' => $nombreDiametres,
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
                'detail' => 'Fournie par la JIRAMA',
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
                'detail' => 'Longueur mesurée avec une marge de 10 %',
                'qte' => round($longueur * 1.1, 2),
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
            [
                'nom' => 'Compteur d’eau',
                'detail' => 'Fourni gratuitement par la JIRAMA',
                'qte' => 1,
                'unite' => 'unité',
                'pu' => 0,
                'jirama' => true,
            ],
        ];
    }

    // Calcul des totaux
    $lignes = collect($materiels)->map(function ($materiel) {
        $materiel['total'] = round($materiel['qte'] * $materiel['pu']);
        return $materiel;
    });

    $totalHT = $lignes->sum('total');
    $montantTVA = round($totalHT * 0.2);
    $totalTTC = $totalHT + $montantTVA;

    // Le total général correspond à la main-d'œuvre HT
    $totalGeneral = $totalHT;
@endphp

<div class="vb-root">

    {{-- Bandeau de statut --}}
    <div class="vb-ribbon">
        <div class="vb-ribbon-left">
            <span class="vb-badge-white">RÉGIE DES EAUX PUBLIQUES</span>
            <span class="vb-sep">•</span>
            <span class="vb-tabular vb-muted">Réf. Branchement #{{ $numeroDossier }}</span>
        </div>
        <div class="vb-ribbon-right">

            <button type="button" class="vb-btn-light" onclick="window.print()">
                Imprimer le dossier
            </button>

            <button type="button" class="vb-btn-light" onclick="telechargerDevisPDF()" @disabled(!$devisDisponible)>
                Télécharger le devis (PDF)
            </button>



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
                        <h1 class="vb-h1">
                            Dossier de Branchement d'Eau Potable • {{ $numeroDossier }}
                        </h1>
                        <p class="vb-hero-text">
                            Raccordement d'un bâtiment individuel neuf au réseau d'adduction. Fournitures et
                            main-d'œuvre chiffrées selon le bordereau JIRAMA.
                        </p>
                    </div>

                    <div class="vb-status-card">
                        <div class="vb-status-line">
                            <span class="{{ $mesureDisponible ? 'vb-dot-green' : 'vb-dot-orange' }}"></span>

                            <span class="vb-status-step">
                                {{ $mesureDisponible ? 'Mesure de terrain effectuée' : 'En attente de mesure terrain' }}
                            </span>
                        </div>

                        <span class="vb-status-title">
                            {{ $client->statut ?? 'Statut non renseigné' }}
                        </span>

                        <span class="vb-status-sub">
                            @if ($devisDisponible)
                                Le devis de main-d'œuvre est disponible.
                            @else
                                Le devis sera établi après la réalisation de la mesure terrain.
                            @endif
                        </span>
                    </div>
                </div>

                {{-- Stepper --}}
                <div class="vb-stepper">
                    @php
                        $etapes = [
                            ['1', 'Demande déposée', $dateDemande, 'done'],
                            [
                                '2',
                                'Étude sur terrain',
                                $mesureDisponible ? $dateMesure : 'En attente',
                                $mesureDisponible ? 'done' : 'current',
                            ],
                            ['3', 'Validation administrative', 'Selon instruction du dossier', 'todo'],
                            [
                                '4',
                                'Devis et approvisionnement',
                                $devisDisponible ? 'Devis disponible' : 'En attente de mesure',
                                $devisDisponible ? 'current' : 'todo',
                            ],
                            ['5', 'Travaux', 'À planifier', 'todo'],
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

                    {{-- Demandeur --}}
                    <div class="vb-info-card">
                        <span class="vb-info-label">Demandeur principal</span>

                        <div>
                            <span class="vb-info-main">
                                {{ $nomClient }}
                            </span>

                            <span class="vb-info-sub">
                                Titulaire du dossier
                            </span>
                        </div>

                        <div class="vb-info-foot">
                            <span>CIN :</span>

                            <span class="vb-chip">
                                {{ $cinClient }}
                            </span>
                        </div>
                    </div>

                    {{-- Localisation --}}
                    <div class="vb-info-card">
                        <span class="vb-info-label">Implantation du branchement</span>

                        <div>
                            <span class="vb-info-main">
                                {{ $adresse }}
                            </span>

                            <span class="vb-info-sub">
                                Localisation relevée sur le terrain
                            </span>
                        </div>

                        <div class="vb-info-foot">
                            <span>Coordonnées GPS :</span>

                            <span class="vb-tabular">
                                @if ($latitude !== null && $longitude !== null)
                                    {{ $latitude }}, {{ $longitude }}
                                @else
                                    Non disponibles
                                @endif
                            </span>
                        </div>
                    </div>

                    {{-- Métrage --}}
                    <div class="vb-info-card">
                        <span class="vb-info-label">Relevé métrique</span>

                        <div class="vb-metre">
                            <span class="vb-metre-value">
                                {{ $mesureDisponible ? number_format($longueur, 2, ',', ' ') : '--' }}
                            </span>

                            <span class="vb-metre-unit">
                                mètres linéaires
                            </span>
                        </div>

                        <div class="vb-info-foot">
                            <span>Date de mesure :</span>

                            <span>{{ $dateMesure }}</span>
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
                        <h3 class="vb-h3 vb-primary">
                            Coupe du tracé d'adduction
                            @if ($mesureDisponible)
                                ({{ number_format($longueur, 2, ',', ' ') }} m)
                            @endif
                        </h3>
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
                                            <span
                                                class="vb-item-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
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
                                <td colspan="4" class="vb-right">
                                    Total main-d'œuvre HT :
                                </td>

                                <td class="vb-right vb-total">
                                    {{ $ar($totalHT) }}
                                </td>
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

                    <div class="vb-recap-row">
                        <span>Nombre d'articles</span>
                        <span class="vb-tabular">{{ $lignes->count() }}</span>
                    </div>

                    <div class="vb-recap-row">
                        <span>Articles fournis par la JIRAMA</span>
                        <span class="vb-tabular">
                            {{ $lignes->where('jirama', true)->count() }}
                        </span>
                    </div>

                    <div class="vb-recap-row">
                        <span>Total main-d'œuvre HT</span>
                        <span class="vb-tabular">{{ $ar($totalHT) }}</span>
                    </div>

                    <div class="vb-recap-row">
                        <span>TVA (20 %)</span>
                        <span class="vb-tabular">{{ $ar($montantTVA) }}</span>
                    </div>

                    <div class="vb-recap-row vb-recap-total">
                        <span>Total TTC à payer</span>
                        <span class="vb-tabular">{{ $ar($totalTTC) }}</span>
                    </div>

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
                        <span class="vb-badge-gray">
                            Visite effectuée le {{ $dateMesure }}
                        </span>
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
                            <text x="350" y="31" fill="#FFFFFF" font-size="11" font-weight="bold"
                                text-anchor="middle">
                                {{ number_format($longueur, 2, ',', ' ') }} MÈTRES
                            </text>
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
                        @if ($mesureDisponible && $mesure->plan_image)
                            <div class="vb-card vb-card-pad">
                                <h3 class="vb-h3 vb-primary">Plan de parcours enregistré</h3>

                                <img src="{{ \Illuminate\Support\Facades\Storage::url($mesure->plan_image) }}"
                                    alt="Plan de parcours du branchement"
                                    style="width: 100%; height: auto; border-radius: 10px;">
                            </div>
                        @else
                            <div class="vb-card vb-card-pad">
                                <h3 class="vb-h3 vb-primary">Plan de parcours</h3>

                                <p class="vb-body vb-muted">
                                    Aucun plan de parcours n'est encore disponible.
                                </p>
                            </div>
                        @endif
                        <div class="vb-schema-foot">
                            <span>Tuyau PVC 16 bars DN 32</span>
                            <span>Marge de 10 % incluse</span>
                        </div>
                    </div>

                    <div class="vb-note">
                        <span class="vb-note-title">Informations de la mesure :</span>

                        <p class="vb-body vb-muted">
                            Nombre de changements de direction :
                            {{ $mesureDisponible ? $nombreDirections : 'En attente' }}.

                            Nombre de changements de diamètre :
                            {{ $mesureDisponible ? $nombreDiametres : 'En attente' }}.

                            Autorisation de passage :
                            {{ $autorisation }}.
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
<style>
    @media print {

        /* Masquer tout le reste de la page */
        body * {
            visibility: hidden;
        }

        /* Afficher uniquement le composant devis */
        .vb-root,
        .vb-root * {
            visibility: visible;
        }

        .vb-root {
            position: absolute;
            left: 0;
            top: 0;
            width: 100%;
            background: white !important;
            color: black !important;
        }

        /* Masquer les boutons et les onglets */
        .vb-ribbon-right,
        .vb-tabs,
        .vb-callout button {
            display: none !important;
        }

        /* Afficher le bordereau et le récapitulatif */
        #vb-panel-materiel,
        #vb-panel-devis {
            display: block !important;
            visibility: visible !important;
        }

        /* Ne pas imprimer le panneau implantation */
        #vb-panel-implantation {
            display: none !important;
        }

        /* Afficher les panneaux normalement masqués */
        .vb-panel.vb-hidden {
            display: block !important;
        }

        /* Éviter de couper les tableaux entre deux pages */
        .vb-card {
            break-inside: avoid;
        }

        .vb-table {
            width: 100%;
        }

        /* Masquer les éléments décoratifs inutiles */
        .vb-hero-glow {
            display: none !important;
        }
    }
</style>

<script>
    function telechargerDevisPDF() {
        window.print();
    }
</script>

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
