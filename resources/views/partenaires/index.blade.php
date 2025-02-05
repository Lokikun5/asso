@extends('layouts.app')
@section('title', config('meta.partenaires.title'))
@section('description', config('meta.partenaires.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Nos Partenaires', 'url' => route('partenaires')]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">Nos Partenaires</h1>
            
            <p class="text-center">
                Désireuse de donner aux jeunes les moyens de rêver et de réussir, notre association est le trait d’union entre les talents de demain et les acteurs qui façonnent le monde d’aujourd’hui. 
                En collaborant avec les écoles et universités pour inspirer sur le terrain, les entreprises pour offrir des opportunités concrètes d’immersion et avec les services publics pour mobiliser des ressources, nous créons ensemble une dynamique d’impact. 
                Votre engagement à nos côtés, c’est l’assurance de laisser une empreinte durable, de révéler des talents, et d’inspirer une génération à changer le monde. 
            </p>

            <p class="text-center font-weight-bold">Rejoignez-nous aujourd’hui pour contribuer, promouvoir et construire l’excellence de demain.</p>

            <h2 class="text-center mt-5">Nos partenaires nous font confiance pour façonner les leaders de demain</h2>

            <div class="row mt-4">
                <!-- Écoles et Universités -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-school"></i> Écoles et Universités</h3>
                        <p>Co-organisation d’activités sur site.</p>
                        <ul>
                            <li><strong>Complexe Scolaire « LA SAGESSE »</strong> - Situé à Lomé, Togo (Djidjolé) depuis plus de 20 ans. Cette école soutient notre initiative et prépare ses élèves aux métiers de demain.</li>
                        </ul>
                    </div>
                </div>

                <!-- Entreprises du Secteur Privé -->
                <div class="col-md-6">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-building"></i> Entreprises du Secteur Privé</h3>
                        <p>Accueil de stagiaires et sponsoring.</p>
                        <ul>
                            <li><strong>Entreprise « HEJAUS »</strong> - Implantée en France, spécialisée en modélisation 3D, inspection, diagnostic et calcul de structures existantes.</li>
                        </ul>
                    </div>
                </div>

                <!-- Services Publics -->
                <div class="col-md-6 mt-4">
                    <div class="p-4 border rounded shadow-sm">
                        <h3><i class="fas fa-landmark"></i> Services Publics</h3>
                        <p>Soutien pour accéder à des subventions.</p>
                        <ul>
                            <li>🔍 Recherche d’autres partenaires en cours.</li>
                        </ul>
                    </div>
                </div>
            </div>

            <h2 class="text-center mt-5"><i class="fas fa-star"></i> Nos membres actifs et bénévoles</h2>

            <div class="row mt-4">
            @foreach($partners as $partner)
            <div class="col-md-6 mb-4">
                <div class="p-4 border rounded shadow-sm d-flex align-items-center">
                    <img src="{{ asset($partner->profile_picture) }}" alt="{{ $partner->first_name }}" class="rounded-circle me-3" width="80" height="80">
                    <div>
                        <h3><i class="fas fa-handshake"></i> {{ $partner->first_name }} {{ $partner->last_name }}</h3>
                        <p>{{ Str::limit($partner->description, 100) }}</p>
                        <a href="{{ route('partenaire.show', $partner->slug) }}" class="btn btn-color btn-primary">
                            Voir le partenaire
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
        </div>


            @if($partners->isEmpty())
                <p class="text-center mt-4 text-muted">Aucun partenaire pour le moment.</p>
            @endif


        </div>
    </section>

    @include('layouts.footer')
@endsection
