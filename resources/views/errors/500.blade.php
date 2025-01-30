@extends('layouts.app')

@section('content')

    @include('layouts.header')
    <body class="text-center">
        <div class="container py-5">
            <h1 class="display-4 text-danger">500</h1>
            <p class="lead">Oups ! Une erreur interne s'est produite.</p>
            <a href="{{ url('/') }}" class="btn btn-primary">Retour à l'accueil</a>
        </div>
    </body>

@endsection