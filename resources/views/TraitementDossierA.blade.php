{{--
    Composant Blade : dossier-instruction
    Utilisation : <x-dossier-instruction />
    Dépendances : Tailwind CSS CDN + Material Symbols (chargés ci-dessous).
--}}
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Plus+Jakarta+Sans:wght@100..900&display=swap" rel="stylesheet">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config={"darkMode":"class","theme":{"extend":{"colors":{"on-tertiary-fixed-variant":"#822700","on-error":"#ffffff","on-surface-variant":"#44474e","inverse-surface":"#2d3133","outline-variant":"#c4c6cf","surface":"#f7f9fc","on-background":"#191c1e","on-primary-fixed-variant":"#314769","secondary-container":"#0266ff","tertiary-fixed":"#ffdbcf","tertiary-fixed-dim":"#ffb59c","on-error-container":"#93000a","on-primary-fixed":"#001c3b","on-secondary-fixed-variant":"#003fa4","surface-container-low":"#f2f4f7","background":"#f7f9fc","tertiary-container":"#481200","inverse-primary":"#b1c7f0","inverse-on-surface":"#eff1f4","surface-bright":"#f7f9fc","surface-container-lowest":"#ffffff","surface-variant":"#e0e3e6","error":"#ba1a1a","surface-container":"#eceef1","on-tertiary-fixed":"#390c00","on-tertiary":"#ffffff","on-primary-container":"#778db2","on-secondary":"#ffffff","on-secondary-container":"#f9f7ff","error-container":"#ffdad6","tertiary":"#240500","secondary":"#0050cc","secondary-fixed":"#dae1ff","primary-container":"#0b2545","on-secondary-fixed":"#001849","secondary-fixed-dim":"#b3c5ff","on-primary":"#ffffff","surface-tint":"#495f82","outline":"#74777f","surface-container-highest":"#e0e3e6","on-surface":"#191c1e","primary-fixed-dim":"#b1c7f0","primary-fixed":"#d5e3ff","surface-dim":"#d8dadd","primary":"#001026","on-tertiary-container":"#f85200","surface-container-high":"#e6e8eb"},"borderRadius":{"DEFAULT":"0.125rem","lg":"0.25rem","xl":"0.5rem","full":"0.75rem"},"spacing":{"margin-tablet":"1.5rem","space-sm":"0.5rem","space-lg":"1.5rem","margin":"1rem","gutter-desktop":"1.5rem","margin-desktop":"2.5rem","gutter":"1rem","space-xl":"2.5rem","space-xs":"0.25rem","space-md":"1rem"},"fontFamily":{"body-lg":["Inter"],"data-tabular":["Inter"],"headline-xl-mobile":["Plus Jakarta Sans"],"headline-lg":["Plus Jakarta Sans"],"label-md":["Inter"],"body-md":["Inter"],"headline-xl":["Plus Jakarta Sans"],"label-sm":["Inter"],"body-sm":["Inter"],"headline-lg-mobile":["Plus Jakarta Sans"],"headline-sm":["Plus Jakarta Sans"],"headline-md":["Plus Jakarta Sans"],"label-lg":["Inter"]},"fontSize":{"body-lg":["16px",{"lineHeight":"24px","fontWeight":"400"}],"data-tabular":["13px",{"lineHeight":"18px","fontWeight":"500"}],"headline-xl-mobile":["28px",{"lineHeight":"36px","fontWeight":"700"}],"headline-lg":["32px",{"lineHeight":"40px","fontWeight":"600"}],"label-md":["12px",{"lineHeight":"16px","fontWeight":"600"}],"body-md":["14px",{"lineHeight":"20px","fontWeight":"400"}],"headline-xl":["40px",{"lineHeight":"48px","fontWeight":"700"}],"label-sm":["11px",{"lineHeight":"14px","fontWeight":"600"}],"body-sm":["12px",{"lineHeight":"16px","fontWeight":"400"}],"headline-lg-mobile":["24px",{"lineHeight":"32px","fontWeight":"600"}],"headline-sm":["18px",{"lineHeight":"24px","fontWeight":"600"}],"headline-md":["24px",{"lineHeight":"32px","fontWeight":"600"}],"label-lg":["14px",{"lineHeight":"20px","fontWeight":"500"}]}}}}
</script>
<link rel="stylesheet" href="{{ asset('css/TraitementDossierA.css') }}">

<aside id="vr-sidebar" class="fixed left-0 top-0 h-full w-72 bg-surface-container-low shadow-[1px_0_10px_rgba(11,37,69,0.05)] z-50 flex flex-col justify-between"><div class="flex flex-col"><div class="h-16 px-space-lg flex items-center gap-space-sm bg-surface-container-lowest"><img alt="Logo VoltaRéseau Bleu & Orange" class="h-8 w-auto object-contain" src="https://lh3.googleusercontent.com/aida/AEtjO1WpgRULcquGjhMFPox54PpJfpQ6Jx4LuNxgL8TwLV_jYeGoMjzOFiJDiMlYU6rb6E2MbcCfvP9pzImSy1iXSwmmizabeQIg2JtjdI3ztnWSq4EbEsAaKDD2weXH1V6FQPmuZekAMd55IT5uoF8dwvOYKiNi9ANWfG31zvqEG5b8QQ-YkuXG76iMuQcHbZ40VdtuDvmO_IE47tQfofs74jplsRvIcJm2mP5m2oOkKFuXgfnsvyk20BY6SPA"/><div class="flex flex-col"><span class="font-headline-sm text-headline-sm text-primary tracking-tight leading-none">VoltaRéseau</span><span class="font-label-sm text-label-sm text-on-surface-variant leading-none mt-1">Poste d'Instruction</span></div></div><div class="p-space-md"><div class="flex items-center gap-space-sm px-space-md py-space-sm rounded bg-surface-container-high"><span class="w-2.5 h-2.5 rounded-full bg-secondary-container"></span><span class="font-label-sm text-label-sm text-primary uppercase font-bold tracking-wider">Portail Ingénierie & Admin</span></div></div><nav class="flex flex-col gap-1 px-space-md" data-active-classes="bg-primary-container text-on-primary font-label-lg rounded"><a class="flex items-center gap-space-md px-space-md py-2.5 rounded text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="supervision-grid" href="#"><span class="material-symbols-outlined text-[20px]">hub</span><span>Supervision & Postes HTA</span></a><a aria-current="page" class="flex items-center gap-space-md px-space-md py-2.5 transition-all bg-primary-container text-on-primary font-label-lg rounded" data-path="instruction-dossiers" href="#"><span class="material-symbols-outlined text-[20px]">folder_supervised</span><span>Instruction des Dossiers</span></a><a class="flex items-center gap-space-md px-space-md py-2.5 rounded text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="chiffrage-devis" href="#"><span class="material-symbols-outlined text-[20px]">request_quote</span><span>Chiffrage & Devis Réseau</span></a><a class="flex items-center gap-space-md px-space-md py-2.5 rounded text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="validation-reglementaire" href="#"><span class="material-symbols-outlined text-[20px]">verified</span><span>Validation Réglementaire Enedis</span></a><a class="flex items-center gap-space-md px-space-md py-2.5 rounded text-on-surface-variant hover:bg-surface-container hover:text-on-surface transition-all" data-path="rapports-techniques-terrain" href="#"><span class="material-symbols-outlined text-[20px]">assignment</span><span>Rapports Terrain & Relevés</span></a></nav></div><div class="p-space-md"><div class="bg-surface-container-lowest p-space-md rounded flex items-center justify-between shadow-[0_1px_4px_rgba(11,37,69,0.04)]"><div class="flex items-center gap-space-sm"><img alt="Profile" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida/AEtjO1WcYRmghDZ0SCqvLZSVnAE8ZmbnFL1sqVeSQM_TPhrvhGJb27knXdjq91--pgeAVrt8lq-pDTgS7mHhubSHAJpLpx0MS1NS_OczxtmCfROY5zQOgFSLMk5Nz0hp98eWDIlSooLTnv0lKlt9OM20cKTnNlCGwG3znBLFIlTtegTp0TpE_dC8bwOubD_PTMmtQjhNtfyXJHKFB0h_EjNy4-YC5Ew2VD7MO8C7UIzccbkKNWatlsygMz_jHw"/><div class="flex flex-col"><span class="font-label-sm text-label-sm text-primary font-bold">Ing. Sarah Laurent</span><span class="font-body-sm text-body-sm text-on-surface-variant">Pôle Raccordement</span></div></div><a class="text-on-surface-variant hover:text-error transition-colors p-1" data-path="portail-connexion" href="#" title="Se déconnecter"><span class="material-symbols-outlined text-[20px]">power_settings_new</span></a></div></div></aside><div class="pl-72 vr-main-wrapper"><header id="vr-header" class="fixed top-0 left-72 right-0 h-16 bg-surface-container-lowest/90 backdrop-blur-md shadow-[0_1px_8px_rgba(11,37,69,0.04)] z-40 flex items-center justify-between px-space-lg"><div class="flex items-center gap-space-md"><span class="vr-status-label font-label-md text-label-md text-on-surface-variant bg-surface-container px-2.5 py-1 rounded flex items-center gap-1.5"><span class="w-2 h-2 rounded-full bg-secondary"></span>Réseau National RTE/Enedis • Synchronisé</span></div><div class="flex items-center gap-space-md"><a class="flex items-center gap-space-xs px-3 py-1.5 rounded bg-surface-container-high text-primary hover:bg-surface-variant font-label-sm text-label-sm transition-colors" data-path="suivi-en-direct" href="#"><span class="material-symbols-outlined text-[16px]">open_in_new</span>Basculer Espace Client</a><div class="h-6 w-[1px] bg-surface-variant"></div><button class="p-2 text-on-surface-variant hover:text-on-surface rounded hover:bg-surface-container"><span class="material-symbols-outlined text-[20px]">notifications</span></button><img alt="Profile" class="w-8 h-8 rounded-full object-cover" src="https://lh3.googleusercontent.com/aida/AEtjO1WcYRmghDZ0SCqvLZSVnAE8ZmbnFL1sqVeSQM_TPhrvhGJb27knXdjq91--pgeAVrt8lq-pDTgS7mHhubSHAJpLpx0MS1NS_OczxtmCfROY5zQOgFSLMk5Nz0hp98eWDIlSooLTnv0lKlt9OM20cKTnNlCGwG3znBLFIlTtegTp0TpE_dC8bwOubD_PTMmtQjhNtfyXJHKFB0h_EjNy4-YC5Ew2VD7MO8C7UIzccbkKNWatlsygMz_jHw"/></div></header><main class="relative pt-16 bg-surface min-h-[calc(100vh-60px)] px-space-lg py-space-lg"><div class="flex flex-col w-full gap-space-lg pb-12">
<!-- Super-Header & Dossier Summary Banner -->
<div class="relative overflow-hidden bg-primary-container text-on-primary rounded-xl p-space-lg shadow-md">
<div class="absolute -right-16 -top-16 w-80 h-80 bg-secondary-container/10 rounded-full blur-3xl pointer-events-none"></div>
<div class="absolute right-48 -bottom-20 w-64 h-64 bg-on-tertiary-container/10 rounded-full blur-2xl pointer-events-none"></div>
<div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-space-md">
<div class="flex flex-col gap-1.5">
<div class="flex flex-wrap items-center gap-space-sm">
<span class="px-2.5 py-0.5 rounded bg-surface-container-lowest/15 text-primary-fixed font-data-tabular text-data-tabular tracking-wider uppercase">
            Raccordement BT Individuel
          </span>
<span class="px-2 py-0.5 rounded bg-secondary-container text-on-secondary font-label-sm text-label-sm uppercase flex items-center gap-1">
<span class="w-1.5 h-1.5 rounded-full bg-white animate-pulse"></span> Instruction Phase 3/4
          </span>
<span class="text-on-primary-container font-body-sm text-body-sm">
            Soumis le 18 Fév. 2025 • Échéance légale J-4
          </span>
</div>
<div class="flex flex-wrap items-baseline gap-space-md mt-1">
<h1 class="font-headline-lg text-headline-lg tracking-tight text-white flex items-center gap-2">
<span>Dossier #RAC-2025-0842</span>
<span class="text-on-primary-container text-body-lg font-body-lg font-normal">|</span>
<span class="font-headline-md text-headline-md text-primary-fixed">M. Marc DUPONT</span>
</h1>
</div>
<p class="text-on-primary-container font-body-md text-body-md flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">location_on</span>
          14 Bis Chemin des Hautes Terres, 44240 La Chapelle-sur-Erdre • Réf. Cadastrale : B-114, B-115
        </p>
</div>
<!-- Action Chips Quick KPI -->
<div class="flex items-center gap-3">
<div class="bg-surface-container-lowest/10 backdrop-blur-sm px-4 py-3 rounded-lg flex flex-col items-end">
<span class="font-label-sm text-label-sm text-on-primary-container uppercase">Puissance Souscrite</span>
<span class="font-headline-sm text-headline-sm text-white font-bold">12 kVA Monophasé</span>
</div>
<div class="bg-surface-container-lowest/10 backdrop-blur-sm px-4 py-3 rounded-lg flex flex-col items-end">
<span class="font-label-sm text-label-sm text-on-primary-container uppercase">Type Raccordement</span>
<span class="font-headline-sm text-headline-sm text-tertiary-fixed font-bold">Type 2 (>30m)</span>
</div>
</div>
</div>
</div>
<!-- Stepper Workflow Ribbon -->
<div class="bg-surface-container-lowest p-space-md rounded-xl shadow-sm flex items-center justify-between overflow-x-auto gap-4">
<div class="flex items-center gap-3 min-w-[200px]">
<div class="w-8 h-8 rounded-full bg-secondary-container text-white flex items-center justify-center font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[18px]">check</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface uppercase font-bold">1. Dépôt Initial</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Conforme & Complet</span>
</div>
</div>
<div class="h-0.5 flex-1 bg-secondary-container min-w-[40px]"></div>
<div class="flex items-center gap-3 min-w-[220px]">
<div class="w-8 h-8 rounded-full bg-secondary-container text-white flex items-center justify-center font-label-md text-label-md font-bold">
<span class="material-symbols-outlined text-[18px]">check</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface uppercase font-bold">2. Expertise Terrain</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Maître Mesure Validé</span>
</div>
</div>
<div class="h-0.5 flex-1 bg-secondary-container min-w-[40px]"></div>
<div class="flex items-center gap-3 min-w-[220px]">
<div class="w-8 h-8 rounded-full bg-on-tertiary-container text-white flex items-center justify-center font-label-md text-label-md font-bold shadow-md">
<span class="material-symbols-outlined text-[18px]">gavel</span>
</div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-tertiary-container uppercase font-bold">3. Instruction & Devis</span>
<span class="font-body-sm text-body-sm text-primary font-bold">Session Active</span>
</div>
</div>
<div class="h-0.5 flex-1 bg-surface-variant min-w-[40px]"></div>
<div class="flex items-center gap-3 min-w-[200px] opacity-50">
<div class="w-8 h-8 rounded-full bg-surface-container-highest text-on-surface-variant flex items-center justify-center font-label-md text-label-md font-bold">
        4
      </div>
<div class="flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">4. Signature & Travaux</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">En attente accord</span>
</div>
</div>
</div>
<!-- Operational Grid: 3 Pillars of Control -->
<div class="grid grid-cols-1 xl:grid-cols-12 gap-space-lg">
<!-- COLONNE 1: Dossier Client & Pièces Justificatives (3 Cols on XL) -->
<div class="xl:col-span-4 flex flex-col gap-space-md">
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col h-full">
<div class="flex items-center justify-between pb-space-sm mb-space-md bg-surface-container-low/50 -mx-space-lg -mt-space-lg p-space-md rounded-t-xl">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[22px]">inventory_2</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Dossier & Pièces Justificatives</h2>
</div>
<span class="px-2 py-0.5 bg-surface-container-highest text-on-surface-variant font-label-sm text-label-sm rounded font-bold">
            3/3 Validées
          </span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
          Contrôle de complétude juridique conforme à la norme administrative Enedis-NOI-RES_43E.
        </p>
<!-- Document Item 1: Permis -->
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col gap-2 mb-space-sm hover:shadow-sm transition-shadow">
<div class="flex items-start justify-between">
<div class="flex items-start gap-3">
<span class="p-2 rounded bg-surface-container-lowest text-secondary shadow-sm">
<span class="material-symbols-outlined text-[24px]">assignment</span>
</span>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-primary font-bold">Permis de Construire (PC)</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">PC 044 035 24 K0192 • 142 m²</span>
<span class="font-data-tabular text-data-tabular text-on-surface-variant mt-0.5">Délivré le 12/01/2025 par Mairie</span>
</div>
</div>
<span class="px-2 py-0.5 rounded bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold flex items-center gap-1 shadow-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Conforme
            </span>
</div>
<div class="flex items-center justify-between pt-2 mt-1">
<span class="text-on-surface-variant font-data-tabular text-data-tabular text-xs">PDF • 4.2 Mo</span>
<button class="font-label-sm text-label-sm text-secondary hover:underline flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">visibility</span> Consulter l'acte
            </button>
</div>
</div>
<!-- Document Item 2: Cadastre -->
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col gap-2 mb-space-sm hover:shadow-sm transition-shadow">
<div class="flex items-start justify-between">
<div class="flex items-start gap-3">
<span class="p-2 rounded bg-surface-container-lowest text-secondary shadow-sm">
<span class="material-symbols-outlined text-[24px]">map</span>
</span>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-primary font-bold">Extrait Cadastral Officiel</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Section B, Parcelles 114 & 115</span>
<span class="font-data-tabular text-data-tabular text-on-surface-variant mt-0.5">Échelle 1:500 • Géomètre Expert</span>
</div>
</div>
<span class="px-2 py-0.5 rounded bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold flex items-center gap-1 shadow-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Certifié
            </span>
</div>
<div class="flex items-center justify-between pt-2 mt-1">
<span class="text-on-surface-variant font-data-tabular text-data-tabular text-xs">DWG / PDF • 8.9 Mo</span>
<button class="font-label-sm text-label-sm text-secondary hover:underline flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">visibility</span> Voir le tracé
            </button>
</div>
</div>
<!-- Document Item 3: CNI -->
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col gap-2 mb-space-md hover:shadow-sm transition-shadow">
<div class="flex items-start justify-between">
<div class="flex items-start gap-3">
<span class="p-2 rounded bg-surface-container-lowest text-secondary shadow-sm">
<span class="material-symbols-outlined text-[24px]">badge</span>
</span>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg text-primary font-bold">Identité du Pétitionnaire</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">CNI M. Marc DUPONT</span>
<span class="font-data-tabular text-data-tabular text-on-surface-variant mt-0.5">Validité : 11/2031 • FranceConnect+</span>
</div>
</div>
<span class="px-2 py-0.5 rounded bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold flex items-center gap-1 shadow-sm">
<span class="material-symbols-outlined text-[14px]">check_circle</span> Vérifié
            </span>
</div>
<div class="flex items-center justify-between pt-2 mt-1">
<span class="text-on-surface-variant font-data-tabular text-data-tabular text-xs">PDF • 1.1 Mo</span>
<button class="font-label-sm text-label-sm text-secondary hover:underline flex items-center gap-1">
<span class="material-symbols-outlined text-[16px]">visibility</span> Contrôle régalien
            </button>
</div>
</div>
<!-- Demandeur Profile Card -->
<div class="mt-auto p-space-md rounded-lg bg-surface-container-high/60 flex flex-col gap-2">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-primary text-[18px]">account_box</span>
<span class="font-label-sm text-label-sm text-primary uppercase font-bold">Contact Client Privilégié</span>
</div>
<div class="grid grid-cols-2 gap-2 text-body-sm font-body-sm">
<span class="text-on-surface-variant">Téléphone :</span>
<span class="font-data-tabular text-data-tabular text-primary font-bold">06 42 19 88 00</span>
<span class="text-on-surface-variant">Courriel :</span>
<span class="font-body-sm text-body-sm text-primary truncate">m.dupont@ouest-mail.fr</span>
<span class="text-on-surface-variant">Statut d'occupation :</span>
<span class="font-body-sm text-body-sm text-primary">Propriétaire Bâtisseur</span>
</div>
</div>
</div>
</div>
<!-- COLONNE 2: Données Transmises par le Maître Mesure (4 Cols on XL) -->
<div class="xl:col-span-4 flex flex-col gap-space-md">
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col h-full">
<div class="flex items-center justify-between pb-space-sm mb-space-md bg-surface-container-low/50 -mx-space-lg -mt-space-lg p-space-md rounded-t-xl">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[22px]">straighten</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Relevé Maître Mesure</h2>
</div>
<span class="px-2 py-0.5 bg-surface-container-highest text-primary font-data-tabular text-data-tabular rounded font-bold">
            Réf: MM-7840
          </span>
</div>
<!-- Telemetry Key Metrics: Distance & Typologie -->
<div class="grid grid-cols-2 gap-3 mb-space-md">
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Distance Réseau-Coffret</span>
<div class="flex items-baseline gap-1 mt-1">
<span class="font-headline-lg text-headline-lg text-on-tertiary-container font-bold">38.5</span>
<span class="font-body-md text-body-md text-primary font-bold">mètres</span>
</div>
<div class="mt-2 flex items-center gap-1.5 text-xs text-on-surface-variant">
<span class="w-2 h-2 rounded-full bg-on-tertiary-container"></span>
<span>Dépassement seuil 30m</span>
</div>
</div>
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col">
<span class="font-label-sm text-label-sm text-on-surface-variant uppercase">Configuration Technique</span>
<div class="flex items-baseline gap-1 mt-1">
<span class="font-headline-lg text-headline-lg text-secondary font-bold">Type 2</span>
</div>
<div class="mt-2 text-xs text-on-surface-variant">
              Comptage en limite de propriété
            </div>
</div>
</div>
<!-- Phase Balancing & Cable Specs Preview -->
<div class="p-space-md rounded-lg bg-surface-container-low mb-space-md flex flex-col gap-2">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm text-primary font-bold uppercase">Câblage Dérivé & Chute de Tension</span>
<span class="font-data-tabular text-data-tabular text-secondary font-bold">ΔU = 1.28% (< 2%)</span>
</div>
<!-- Phase bar representation -->
<div class="w-full bg-surface-container-highest h-2 rounded-full overflow-hidden flex">
<div class="bg-secondary-container h-full w-[45%]" title="Phase L1 active"></div>
<div class="bg-primary h-full w-[25%]" title="Réserve"></div>
<div class="bg-on-tertiary-container h-full w-[30%]" title="Sécurité"></div>
</div>
<div class="flex justify-between text-xs text-on-surface-variant font-data-tabular">
<span>Section : 2x35 mm² Alu</span>
<span>Poste Source : HTA Beaujoire 04</span>
</div>
</div>
<!-- Field Photos -->
<div class="flex flex-col gap-2 mb-space-md">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm text-primary uppercase font-bold flex items-center gap-1.5">
<span class="material-symbols-outlined text-[16px]">photo_camera</span> Relevés Photographiques Géolocalisés
            </span>
<span class="font-body-sm text-body-sm text-secondary font-bold">2 Clichés Certifiés</span>
</div>
<div class="grid grid-cols-2 gap-3">
<div class="relative group rounded-lg overflow-hidden bg-surface-container-high aspect-video">
<img class="w-full h-full object-cover" data-alt="Clear high resolution technical inspection photo of a concrete utility electrical pole with low-voltage overhead distribution lines and cable rise under bright daylight with engineering inspection overlay markings in crisp electric blue" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBFFT0arrpQJA3SQndjPXj-9EJAARoz1UsuNCj0TknmmWNI0UicCqa97djk4C4V2RgXJwqptBpV12slu21UczhKmSM6QOvE2Pxqss547IAdcisiQW29ZE2VFyUJJ3NgOIoScyus5XLz46uT2gWUyeZLx3lxlbgcXQWRxFsW2qa1Q9N5P06PxNaxhSECgHZXu2S5FWM7xDPEBN-rmvx3CoLMacTu5gZV4DlUO82Rvs7IM5JUiVrjZs2Z"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-90"></div>
<div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white">
<span class="font-label-sm text-label-sm font-bold truncate">Poteau P-09 HTA/BT</span>
<span class="material-symbols-outlined text-[16px]">check_circle</span>
</div>
</div>
<div class="relative group rounded-lg overflow-hidden bg-surface-container-high aspect-video">
<img class="w-full h-full object-cover" data-alt="Technical close-up photo of an outdoor polyurethane electrical connection meter box enclosure placed on boundary stone pillar in sunny daytime French suburban terrain with safety stickers and conduit access" src="https://lh3.googleusercontent.com/aida-public/AB6AXuDzrt4kgoTJ7cyG2z97wU6mNNgzumg4ZqUbeOXEmv3mEzGh84wdYHIfGr86-fQ3dQT7c5asB6ptk-c4P6M63kGIbqVsjomlvhpUGf_Ivm12GiJj08C3Dxa8RbNcHBT7Pgzc1wevGHZEOIK7JNwQsvn05HZ25tHqhKFITHOlm7-TxOwhhrNTwv-jdYIxkymswkerXYnXV84maxrhowcXlARnRpFNpTDTwtwjADK79_ElA0_nV8R7rFoP"/>
<div class="absolute inset-0 bg-gradient-to-t from-primary/80 via-transparent to-transparent opacity-90"></div>
<div class="absolute bottom-2 left-2 right-2 flex items-center justify-between text-white">
<span class="font-label-sm text-label-sm font-bold truncate">Coffret Borne Limite</span>
<span class="material-symbols-outlined text-[16px]">check_circle</span>
</div>
</div>
</div>
</div>
<!-- Servitude de passage Banner (High focus) -->
<div class="mt-auto p-space-md rounded-lg bg-surface-container-low flex flex-col gap-2">
<div class="flex items-start gap-3">
<span class="p-1.5 rounded bg-surface-container-lowest text-secondary shadow-sm">
<span class="material-symbols-outlined text-[20px]">handshake</span>
</span>
<div class="flex flex-col flex-1">
<div class="flex items-center justify-between">
<span class="font-label-md text-label-md text-primary font-bold">Convention de Servitude</span>
<span class="px-2 py-0.5 rounded bg-surface-container-lowest text-secondary font-label-sm text-label-sm font-bold shadow-sm">Enregistrée</span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mt-1">
                Autorisation manuscrite parcelle riveraine <strong>B-114</strong> signée par les consorts Voisin, certifiée conforme par Maître Tessier (Notaire).
              </p>
<div class="flex items-center gap-4 mt-2 font-data-tabular text-data-tabular text-xs text-on-surface-variant">
<span>Réf : SERV-2025-09</span>
<span>Portée : Tranchée 0.8m</span>
</div>
</div>
</div>
</div>
</div>
</div>
<!-- COLONNE 3: Calculateur Tarifaire & Devis Estimatif (5 Cols on XL) -->
<div class="xl:col-span-4 flex flex-col gap-space-md">
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col h-full">
<div class="flex items-center justify-between pb-space-sm mb-space-md bg-surface-container-low/50 -mx-space-lg -mt-space-lg p-space-md rounded-t-xl">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[22px]">calculate</span>
<h2 class="font-headline-sm text-headline-sm text-primary">Calculateur & Devis Réseau</h2>
</div>
<span class="px-2 py-0.5 bg-secondary-container text-white font-label-sm text-label-sm rounded uppercase font-bold">
            Barème TURPE 6
          </span>
</div>
<p class="font-body-sm text-body-sm text-on-surface-variant mb-space-md">
          Chiffrage automatisé conformément au catalogue des prestations Enedis en vigueur.
        </p>
<!-- Detailed Breakdown Table -->
<div class="flex flex-col divide-y divide-surface-variant text-body-sm font-body-sm mb-space-md">
<!-- Line 1 -->
<div class="py-2.5 flex items-center justify-between gap-2">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary">Forfait branchement BT 12 kVA</span>
<span class="text-xs text-on-surface-variant">Liaison standard réseau jusqu'à 30m</span>
</div>
<span class="font-data-tabular text-data-tabular text-primary font-bold">950,00 €</span>
</div>
<!-- Line 2 -->
<div class="py-2.5 flex items-center justify-between gap-2">
<div class="flex flex-col">
<div class="flex items-center gap-1.5">
<span class="font-label-md text-label-md text-primary">Supplément distance (>30m)</span>
<span class="px-1.5 py-0.2 rounded bg-surface-container text-on-tertiary-container font-data-tabular text-xs font-bold">+8.5m</span>
</div>
<span class="text-xs text-on-surface-variant">42,00 € / mètre linéaire supplémentaire</span>
</div>
<span class="font-data-tabular text-data-tabular text-on-tertiary-container font-bold">357,00 €</span>
</div>
<!-- Line 3 -->
<div class="py-2.5 flex items-center justify-between gap-2">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary">Travaux d'extension voirie</span>
<span class="text-xs text-on-surface-variant">Fourreau TPC Ø90 + Traversée enrobé</span>
</div>
<span class="font-data-tabular text-data-tabular text-primary font-bold">420,00 €</span>
</div>
<!-- Line 4 -->
<div class="py-2.5 flex items-center justify-between gap-2">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary">Pose compteur communicant Linky</span>
<span class="text-xs text-on-surface-variant">Module radio CPL G3 + AGCP différentiel</span>
</div>
<span class="font-data-tabular text-data-tabular text-primary font-bold">65,00 €</span>
</div>
<!-- Line 5: Deduction -->
<div class="py-2.5 flex items-center justify-between gap-2">
<div class="flex flex-col">
<span class="font-label-md text-label-md text-secondary font-bold">Déduction réfection collectivités</span>
<span class="text-xs text-on-surface-variant">Quote-part aménagement voirie communale</span>
</div>
<span class="font-data-tabular text-data-tabular text-secondary font-bold">-150,00 €</span>
</div>
</div>
<!-- Subtotals calculation -->
<div class="p-space-md rounded-lg bg-surface-container-low flex flex-col gap-1.5 mb-space-md">
<div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant">
<span>Total Forfaitaire Hors Taxes :</span>
<span class="font-data-tabular text-data-tabular text-primary">1 642,00 € HT</span>
</div>
<div class="flex justify-between text-body-sm font-body-sm text-on-surface-variant">
<span>TVA Applicable (20.00%) :</span>
<span class="font-data-tabular text-data-tabular text-primary">328,40 €</span>
</div>
</div>
<!-- Highlighted Total Box (Orange Énergétique & Bleu Nuit) -->
<div class="mt-auto relative overflow-hidden rounded-xl bg-primary-container p-space-md text-white shadow-md">
<div class="absolute right-0 top-0 bottom-0 w-2.5 bg-on-tertiary-container"></div>
<div class="flex flex-col gap-1">
<div class="flex items-center justify-between">
<span class="font-label-sm text-label-sm uppercase tracking-wider text-primary-fixed">Montant Net à Payer Client</span>
<span class="px-2 py-0.5 rounded bg-on-tertiary-container text-white font-label-sm text-label-sm font-bold uppercase">
                Validé Réseau
              </span>
</div>
<div class="flex items-baseline justify-between mt-1">
<span class="font-headline-xl text-headline-xl font-bold tracking-tight text-white">
                1 970,40 <span class="text-headline-md font-normal text-tertiary-fixed">€ TTC</span>
</span>
</div>
<span class="font-data-tabular text-data-tabular text-xs text-on-primary-container mt-1">
              Acompte requis à l'acceptation : 591,12 € (30%) • Validité devis : 3 mois
            </span>
</div>
</div>
</div>
</div>
</div>
<!-- Bloc Inférieur: Checklist de Validation Réglementaire Finale & Actions -->
<div class="bg-surface-container-lowest p-space-lg rounded-xl shadow-sm flex flex-col gap-space-md">
<div class="flex flex-col md:flex-row md:items-center justify-between pb-space-sm gap-2">
<div class="flex items-center gap-2">
<span class="material-symbols-outlined text-secondary text-[24px]">verified_user</span>
<h3 class="font-headline-sm text-headline-sm text-primary">Contrôles de Sécurité & Conformité NF C 14-100</h3>
</div>
<span class="font-body-sm text-body-sm text-on-surface-variant flex items-center gap-1.5">
<span class="w-2 h-2 rounded-full bg-secondary-container"></span> Audit automatisé franchi sans réserve bloquante
      </span>
</div>
<!-- Regulatory Interactive Checkboxes -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-space-md">
<!-- Checkbox 1 -->
<label class="p-space-md rounded-lg bg-surface-container-low flex items-start gap-3 cursor-pointer hover:bg-surface-container transition-colors group">
<input checked="" class="mt-1 h-5 w-5 rounded bg-white text-secondary-container accent-secondary focus:ring-0 cursor-pointer" type="checkbox"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary font-bold group-hover:text-secondary transition-colors">Norme NF C 14-100</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Liaison en domaine privé conforme aux prescriptions de comptage limite.</span>
</div>
</label>
<!-- Checkbox 2 -->
<label class="p-space-md rounded-lg bg-surface-container-low flex items-start gap-3 cursor-pointer hover:bg-surface-container transition-colors group">
<input checked="" class="mt-1 h-5 w-5 rounded bg-white text-secondary-container accent-secondary focus:ring-0 cursor-pointer" type="checkbox"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary font-bold group-hover:text-secondary transition-colors">Tension & Perturbation</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Capacité d'accueil poste HTA vérifiée, impédance de boucle conforme.</span>
</div>
</label>
<!-- Checkbox 3 -->
<label class="p-space-md rounded-lg bg-surface-container-low flex items-start gap-3 cursor-pointer hover:bg-surface-container transition-colors group">
<input checked="" class="mt-1 h-5 w-5 rounded bg-white text-on-tertiary-container accent-[#F97316] focus:ring-0 cursor-pointer" type="checkbox"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary font-bold group-hover:text-on-tertiary-container transition-colors">Servitude Tranchée</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Autorisation riveraine B-114 archivée et vérifiée au greffe hypothécaire.</span>
</div>
</label>
<!-- Checkbox 4 -->
<label class="p-space-md rounded-lg bg-surface-container-low flex items-start gap-3 cursor-pointer hover:bg-surface-container transition-colors group">
<input checked="" class="mt-1 h-5 w-5 rounded bg-white text-on-tertiary-container accent-[#F97316] focus:ring-0 cursor-pointer" type="checkbox"/>
<div class="flex flex-col">
<span class="font-label-md text-label-md text-primary font-bold group-hover:text-on-tertiary-container transition-colors">Autorisation Voirie (DICT)</span>
<span class="font-body-sm text-body-sm text-on-surface-variant">Emprise domaine public municipal enregistrée sous téléservice Guichet Unique.</span>
</div>
</label>
</div>
<!-- Signature & Decision Action Bar -->
<div class="flex flex-col sm:flex-row items-center justify-between pt-space-md gap-4 mt-space-sm">
<div class="flex items-center gap-2 text-on-surface-variant font-body-sm text-body-sm">
<span class="material-symbols-outlined text-[20px] text-secondary">mark_email_read</span>
<span>Validation déclenchant l'envoi immédiat de la proposition technique par email sécurisé.</span>
</div>
<div class="vr-action-buttons flex flex-wrap items-center gap-3 w-full sm:w-auto justify-end">
<!-- Secondary Ghost/Utility Button -->
<button class="px-5 py-2.5 rounded text-on-surface-variant hover:text-primary hover:bg-surface-container font-label-lg text-label-lg transition-colors flex items-center gap-2" id="btn-request-info">
<span class="material-symbols-outlined text-[18px]">announcement</span>
          Demander un complément
        </button>
<!-- Secondary Outline Button -->
<button class="px-5 py-2.5 rounded bg-surface-container-lowest text-secondary shadow-sm hover:bg-surface-container-low font-label-lg text-label-lg transition-all flex items-center gap-2">
<span class="material-symbols-outlined text-[18px]">print</span>
          Brouillon Devis PDF
        </button>
<!-- Prominent Safety Orange CTA Button -->
<button class="px-6 py-3 rounded bg-on-tertiary-container hover:bg-tertiary text-white font-label-lg text-label-lg font-bold shadow-md hover:shadow-lg transition-all flex items-center gap-2.5" id="btn-validate-dossier">
<span class="material-symbols-outlined text-[20px]">send_time_extension</span>
          Valider le dossier et générer le devis estimatif
        </button>
</div>
</div>
</div>
<!-- Interactive Feedback Notification Modal Toast -->
<div class="fixed bottom-8 right-8 z-50 transform translate-y-32 opacity-0 transition-all duration-300 pointer-events-none flex items-center gap-3 bg-primary-container text-white px-5 py-4 rounded-xl shadow-xl" id="action-toast">
<div class="w-8 h-8 rounded-full bg-on-tertiary-container flex items-center justify-center text-white">
<span class="material-symbols-outlined text-[20px]">check</span>
</div>
<div class="flex flex-col">
<span class="font-label-lg text-label-lg font-bold">Dossier #RAC-2025-0842 Validé</span>
<span class="font-body-sm text-body-sm text-on-primary-container">Devis de 1 970,40 € transmis à M. Dupont (m.dupont@ouest-mail.fr).</span>
</div>
</div>
</div>
</main><footer class="w-full bg-surface-container-lowest px-space-lg py-space-sm flex items-center justify-between font-body-sm text-body-sm text-on-surface-variant shadow-[0_-1px_4px_rgba(11,37,69,0.02)]"><span>Plateforme VoltaRéseau • Direction Technique de Distribution • NF C 14-100</span><span class="font-data-tabular text-data-tabular">v4.8.2-PROD</span></footer></div>

<script src="{{ asset('js/dossier-instruction.js') }}" defer></script>
