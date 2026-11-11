
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Mon espace | VoltaRéseau</title>
    <link rel="stylesheet" href="{{ asset('css/DemandeRaccordement.css') }}">
    <link rel="stylesheet" href="{{ asset('css/NavClient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ContentSuivi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conteneurSuivi.css') }}">


</head>
<body>

    {{-- Navbar principale --}}
    <x-client.BarNavC :dossier="$client" />

<main>

    {{-- SUIVI DU DOSSIER --}}
    @if (request()->routeIs('suivi', 'client.dashboard'))

        <x-client.ContentSuivi :dossier="$client" />

    {{-- NOUVELLE DEMANDE --}}
    @elseif (request()->routeIs('demande.create'))

        <x-client.DemandeRaccordement />

    {{-- TECHNICIEN TERRAIN --}}
    @elseif (request()->routeIs('technicien'))

        @if (Auth::guard('employe')->check()
            && Auth::guard('employe')->user()->role === 'MAITRE_MESURE')

            <x-Mesure.EtudeTerrain />

        @else

            <x-Admin.LoginAdmin
    action="{{ route('admin.login.submit') }}"
    contexte="technicien"
/>

        @endif

    {{-- DEVIS --}}
    @elseif (request()->routeIs('devis'))

        {{-- Contenu des devis à intégrer ultérieurement --}}

    @endif

</main>

</body>

</html>
