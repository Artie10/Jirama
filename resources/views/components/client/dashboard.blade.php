
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Mon espace client | VoltaRéseau</title>

    <link rel="stylesheet" href="{{ asset('css/NavClient.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ContentSuivi.css') }}">
    <link rel="stylesheet" href="{{ asset('css/conteneurSuivi.css') }}">
</head>
<body>

    <x-client.BarNavC />

    <main>
        <x-client.ContentSuivi />
    </main>

</body>
</html>
