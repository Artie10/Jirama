
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Mon espace | VoltaRéseau</title>

    <link rel="stylesheet" href="{{ asset('css/NavClient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ContentSuivi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conteneurSuivi.css') }}">
</head>
<body>

    {{-- Navbar principale --}}
    <x-client.BarNavC :dossier="$client" />

    <main>

        @if (request()->routeIs('technicien'))

            {{-- Tableau de bord étude sur terrain --}}
            <x-Mesure.EtudeTerrain />

        @else

            {{-- Suivi du dossier client --}}
            <x-client.ContentSuivi :dossier="$client" />

        @endif

    </main>

</body>
</html>
