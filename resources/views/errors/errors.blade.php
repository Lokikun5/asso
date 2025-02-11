<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Erreur {{ $exception->getStatusCode() }}</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="text-center">
    <div class="container py-5 min-vh-100">
        <h1 class="display-4 text-danger">{{ $exception->getStatusCode() }}</h1>
        <p class="lead">
            @if ($exception->getStatusCode() == 404)
                Page non trouvée.
            @else
                Une erreur s'est produite. Veuillez réessayer plus tard.
            @endif
        </p>
        <a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
    </div>
</body>
</html>