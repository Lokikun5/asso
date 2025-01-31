<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message de Contact</title>
</head>
<body>
    <h2>Nouveau message de contact</h2>
    <p><strong>Nom :</strong> {{ $data['nom'] }}</p>
    <p><strong>Prénom :</strong> {{ $data['prenom'] }}</p>
    <p><strong>Email :</strong> {{ $data['email'] }}</p>
    @if(!empty($data['telephone']))
        <p><strong>Téléphone :</strong> {{ $data['telephone'] }}</p>
    @endif
    <p><strong>Message :</strong></p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
