@props([
    'name' => 'plan_parcours',
    'valeur' => null,
    'depart' => "Source d'eau",
    'arrivee' => 'Maison',
    'passage' => 'Terrain de passage',
])

<section class="et-carte et-plan" data-plan-dessin>
    <header class="et-carte-entete">
        <h2 class="et-carte-titre">
            <span class="material-symbols-outlined et-icone-orange">draw</span>
            Plan du parcours du tuyau
        </h2>

        <span class="et-badge et-badge--gris">
            {{ $depart }} → {{ $arrivee }}
        </span>
    </header>

    <div class="et-plan-photo">
        <label class="et-plan-photo-label">
            <span class="material-symbols-outlined">add_a_photo</span>
            Ajouter une photo du terrain
            <input type="file" accept="image/jpeg,image/png,image/webp" data-photo name="plan_fond">
        </label>
        <span class="et-plan-photo-nom" data-photo-nom>
            Aucune photo sélectionnée
        </span>
    </div>

    <div class="et-plan-outils" role="toolbar" aria-label="Outils de dessin">
        <button type="button" class="et-plan-outil is-actif" data-outil="crayon">
            <span class="material-symbols-outlined">edit</span>
            Tracer le tuyau
        </button>

        <button type="button" class="et-plan-outil" data-outil="passage">
            <span class="material-symbols-outlined">ink_highlighter</span>
            {{ $passage }}
        </button>

        <button type="button" class="et-plan-outil" data-outil="depart">
            <span class="material-symbols-outlined">trip_origin</span>
            {{ $depart }}
        </button>

        <button type="button" class="et-plan-outil" data-outil="arrivee">
            <span class="material-symbols-outlined">home</span>
            {{ $arrivee }}
        </button>

        <span class="et-plan-espace"></span>

        <button type="button" class="et-plan-outil" data-action="annuler">
            <span class="material-symbols-outlined">undo</span>
            Annuler
        </button>

        <button type="button" class="et-plan-outil et-plan-outil--danger" data-action="effacer">
            <span class="material-symbols-outlined">delete</span>
            Effacer
        </button>
    </div>

    <div class="et-plan-zone">
        <canvas class="et-plan-canvas" data-label-depart="{{ $depart }}" data-label-arrivee="{{ $arrivee }}"
            aria-label="Zone de dessin du parcours">
        </canvas>

        <div class="et-plan-indication" data-indication>
            Ajoutez une photo du terrain ou dessinez directement sur la grille.
        </div>
    </div>

    <ul class="et-plan-legende">
        <li><span class="et-plan-pastille" style="background:#0369a1"></span> Tuyau</li>
        <li>
            <span class="et-plan-pastille et-plan-pastille--large" style="background:rgba(234,88,12,.45)"></span>
            {{ $passage }}
        </li>
        <li><span class="et-plan-pastille" style="background:#2563eb"></span> {{ $depart }}</li>
        <li><span class="et-plan-pastille" style="background:#16a34a"></span> {{ $arrivee }}</li>
    </ul>

    <input type="hidden" name="{{ $name }}" value="{{ is_string($valeur) ? $valeur : '' }}" data-plan-json>

    <input type="hidden" name="{{ $name }}_image" value="" data-plan-image>

    <div class="et-champ-groupe">

        {{-- Nombre de changements de direction --}}
        <div class="et-champ">
            <label for="nombre_changements_direction">
                Nombre de changements de direction
            </label>

            <input type="number" id="nombre_changements_direction" name="nombre_changements_direction" min="0"
                max="100" step="1" inputmode="numeric"
                value="{{ old('nombre_changements_direction', $mesure->nombre_changements_direction ?? 0) }}" required>

            @error('nombre_changements_direction')
                <span class="et-erreur">{{ $message }}</span>
            @enderror
        </div>

        {{-- Nombre de changements de diamètre --}}
        <div class="et-champ">
            <label for="nombre_changements_diametre">
                Nombre de changements de diamètre
            </label>

            <input type="number" id="nombre_changements_diametre" name="nombre_changements_diametre" min="0"
                max="100" step="1" inputmode="numeric"
                value="{{ old('nombre_changements_diametre', $mesure->nombre_changements_diametre ?? 0) }}" required>

            @error('nombre_changements_diametre')
                <span class="et-erreur">{{ $message }}</span>
            @enderror
        </div>

    </div>
</section>

@once
    <link rel="stylesheet" href="{{ asset('css/plan-dessin.css') }}">
    <script src="{{ asset('js/plan-dessin.js') }}" defer></script>
@endonce
