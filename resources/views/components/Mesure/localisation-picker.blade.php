{{--
    resources/views/components/localisation-picker.blade.php

    Utilisation (dans etude-terrain.blade.php, à l'intérieur du <form>) :
        <x-localisation-picker />
        <x-localisation-picker :latitude="-23.3516" :longitude="43.6685" />

    Champs envoyés avec le formulaire :
        latitude, longitude, adresse_localisation

    Carte : Leaflet + OpenStreetMap (gratuit, sans clé API).
    Recherche d'adresse : Nominatim (déclenchée au clic / Entrée, jamais à chaque frappe).
--}}
@props([
    'id' => 'loc',
    'titre' => 'Localisation du site',
    'latitude' => null,
    'longitude' => null,
    'adresse' => null,
    'centreLat' => -18.8792,   // Antananarivo par défaut : adapte à ta zone
    'centreLng' => 47.5079,
    'zoom' => 6,
])

@once
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/LocalisationPicker.css') }}">
@endonce

@php
    $latVal = old('latitude', $latitude);
    $lngVal = old('longitude', $longitude);
    $adrVal = old('adresse_localisation', $adresse);
@endphp

<section class="loc et-carte" id="{{ $id }}"
         data-centre-lat="{{ $centreLat }}" data-centre-lng="{{ $centreLng }}" data-zoom="{{ $zoom }}">
    <header class="et-carte-entete">
        <h2 class="et-carte-titre">
            <span class="material-symbols-outlined et-icone-orange">location_on</span>
            {{ $titre }}
        </h2>
        <span class="et-badge et-badge--gris" data-loc-etat>Non définie</span>
    </header>

    <button type="button" class="loc-ajouter" data-loc-ajouter aria-expanded="false">
        <span class="material-symbols-outlined">add_location_alt</span>
        <span data-loc-ajouter-texte>Ajouter une localisation</span>
    </button>

    <div class="loc-panneau" data-loc-panneau hidden>
    <div class="loc-recherche">
        <input type="text" class="loc-champ" data-loc-recherche
               placeholder="Adresse, lieu, ou coordonnées / lien Google Maps…" autocomplete="off">
        <button type="button" class="loc-btn" data-loc-chercher>
            <span class="material-symbols-outlined">search</span> Rechercher
        </button>
        <button type="button" class="loc-btn loc-btn--sec" data-loc-gps>
            <span class="material-symbols-outlined">my_location</span> Ma position
        </button>
    </div>

    <div class="loc-carte" data-loc-carte></div>
    <p class="loc-aide">Clique sur la carte ou glisse le repère pour placer précisément le site.</p>
    </div>{{-- /loc-panneau --}}

    <div class="loc-infos">
        <p class="loc-adresse" data-loc-adresse>{{ $adrVal ?: 'Aucune adresse renseignée' }}</p>
        <p class="loc-coord">
            <span data-loc-coord>—</span>
            <a class="loc-lien" data-loc-gmaps href="#" target="_blank" rel="noopener" hidden>
                <span class="material-symbols-outlined">open_in_new</span> Ouvrir dans Google Maps
            </a>
            <button type="button" class="loc-effacer" data-loc-effacer hidden>Effacer</button>
        </p>
        <p class="loc-statut" role="status" aria-live="polite" data-loc-statut hidden></p>
    </div>

    <input type="hidden" name="latitude" data-loc-lat value="{{ $latVal }}">
    <input type="hidden" name="longitude" data-loc-lng value="{{ $lngVal }}">
    <input type="hidden" name="adresse_localisation" data-loc-adr value="{{ $adrVal }}">

    @error('latitude') <p class="et-erreur">{{ $message }}</p> @enderror
    @error('longitude') <p class="et-erreur">{{ $message }}</p> @enderror
</section>

@once
    <script>
        (function () {
            function init(root) {
                var $ = function (s) { return root.querySelector(s); };
                var latIn = $('[data-loc-lat]'), lngIn = $('[data-loc-lng]'), adrIn = $('[data-loc-adr]');
                var etat = $('[data-loc-etat]'), coord = $('[data-loc-coord]'), adrTxt = $('[data-loc-adresse]');
                var gmaps = $('[data-loc-gmaps]'), effacer = $('[data-loc-effacer]'), statut = $('[data-loc-statut]');
                var recherche = $('[data-loc-recherche]');
                var panneau = $('[data-loc-panneau]'), bouton = $('[data-loc-ajouter]'), boutonTxt = $('[data-loc-ajouter-texte]');

                var lat = parseFloat(latIn.value), lng = parseFloat(lngIn.value);
                var existe = !isNaN(lat) && !isNaN(lng);

                var map = L.map($('[data-loc-carte]')).setView(
                    existe ? [lat, lng] : [parseFloat(root.dataset.centreLat), parseFloat(root.dataset.centreLng)],
                    existe ? 17 : parseInt(root.dataset.zoom, 10)
                );
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; contributeurs OpenStreetMap'
                }).addTo(map);

                var marker = null;

                function message(texte, erreur) {
                    statut.hidden = !texte;
                    statut.textContent = texte || '';
                    statut.className = 'loc-statut' + (erreur ? ' loc-statut--erreur' : '');
                }

                function afficher(la, ln) {
                    coord.textContent = la.toFixed(6) + ', ' + ln.toFixed(6);
                    gmaps.href = 'https://www.google.com/maps?q=' + la + ',' + ln;
                    gmaps.hidden = false;
                    effacer.hidden = false;
                    boutonTxt.textContent = 'Modifier la localisation';
                    etat.textContent = 'Définie';
                    etat.className = 'et-badge et-badge--ambre';
                }

                function placer(la, ln, centrer, geocoder) {
                    la = Math.round(la * 1e6) / 1e6;
                    ln = Math.round(ln * 1e6) / 1e6;
                    latIn.value = la;
                    lngIn.value = ln;
                    if (!marker) {
                        marker = L.marker([la, ln], { draggable: true }).addTo(map);
                        marker.on('dragend', function () {
                            var p = marker.getLatLng();
                            placer(p.lat, p.lng, false, true);
                        });
                    } else {
                        marker.setLatLng([la, ln]);
                    }
                    if (centrer) map.setView([la, ln], Math.max(map.getZoom(), 17));
                    afficher(la, ln);
                    if (geocoder) adresseInverse(la, ln);
                }

                function adresseInverse(la, ln) {
                    fetch('https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=' + la + '&lon=' + ln, {
                        headers: { 'Accept': 'application/json' }
                    })
                        .then(function (r) { return r.json(); })
                        .then(function (d) {
                            var a = (d && d.display_name) || '';
                            adrIn.value = a;
                            adrTxt.textContent = a || 'Adresse introuvable pour ce point';
                        })
                        .catch(function () { adrTxt.textContent = 'Adresse indisponible (hors ligne ?)'; });
                }

                function chercher() {
                    var q = recherche.value.trim();
                    if (!q) return;
                    message('');

                    // Coordonnées collées directement ou extraites d'un lien Google Maps (…@-23.35,43.67…)
                    var m = q.match(/(-?\d{1,3}\.\d+)\s*[,;\s]\s*(-?\d{1,3}\.\d+)/);
                    if (m) {
                        placer(parseFloat(m[1]), parseFloat(m[2]), true, true);
                        return;
                    }

                    message('Recherche en cours…');
                    fetch('https://nominatim.openstreetmap.org/search?format=jsonv2&limit=1&q=' + encodeURIComponent(q), {
                        headers: { 'Accept': 'application/json' }
                    })
                        .then(function (r) { return r.json(); })
                        .then(function (res) {
                            if (!res.length) { message('Aucun résultat pour cette recherche.', true); return; }
                            message('');
                            adrIn.value = res[0].display_name;
                            adrTxt.textContent = res[0].display_name;
                            placer(parseFloat(res[0].lat), parseFloat(res[0].lon), true, false);
                        })
                        .catch(function () { message('Recherche impossible (connexion ?).', true); });
                }

                map.on('click', function (e) { placer(e.latlng.lat, e.latlng.lng, false, true); });
                $('[data-loc-chercher]').addEventListener('click', chercher);
                recherche.addEventListener('keydown', function (e) {
                    if (e.key === 'Enter') { e.preventDefault(); chercher(); }
                });

                $('[data-loc-gps]').addEventListener('click', function () {
                    if (!navigator.geolocation) { message('Géolocalisation non supportée.', true); return; }
                    message('Localisation en cours…');
                    navigator.geolocation.getCurrentPosition(function (p) {
                        message('');
                        placer(p.coords.latitude, p.coords.longitude, true, true);
                    }, function () {
                        message('Position refusée ou indisponible.', true);
                    }, { enableHighAccuracy: true, timeout: 10000 });
                });

                effacer.addEventListener('click', function () {
                    if (marker) { map.removeLayer(marker); marker = null; }
                    latIn.value = lngIn.value = adrIn.value = '';
                    coord.textContent = '—';
                    adrTxt.textContent = 'Aucune adresse renseignée';
                    gmaps.hidden = true;
                    effacer.hidden = true;
                    boutonTxt.textContent = 'Ajouter une localisation';
                    etat.textContent = 'Non définie';
                    etat.className = 'et-badge et-badge--gris';
                    message('');
                });

                bouton.addEventListener('click', function () {
                    var ouvrir = panneau.hidden;
                    panneau.hidden = !ouvrir;
                    bouton.setAttribute('aria-expanded', ouvrir ? 'true' : 'false');
                    if (ouvrir) {
                        // La carte était masquée : Leaflet doit recalculer sa taille
                        setTimeout(function () {
                            map.invalidateSize();
                            if (marker) map.setView(marker.getLatLng(), map.getZoom());
                        }, 50);
                    }
                });

                if (existe) placer(lat, lng, false, false);
                setTimeout(function () { map.invalidateSize(); }, 200);
            }

            function demarrer() {
                document.querySelectorAll('.loc').forEach(init);
            }
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', demarrer);
            } else {
                demarrer();
            }
        })();
    </script>
@endonce
