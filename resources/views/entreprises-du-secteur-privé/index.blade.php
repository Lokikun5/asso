@php
    $defaultBanner = '/image/banner.webp';
    $bannerImage = '/image/programmes-banner.jpg'; // Image spécifique à la page

    if (!file_exists(public_path($bannerImage))) {
        $bannerImage = $defaultBanner;
    }
@endphp
@extends('layouts.app')

@section('content')
    @include('layouts.header')
    @include('layouts.banner')
    @php
        $breadcrumbs = [
            ['name' => 'Entreprises du secteur privé', 'url' => route('private.companies')]
        ];
    @endphp
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <section class="page-content py-5">
        <div class="container">
            <h1 class="mb-4">Nos partenaires - entreprises du secteur privé</h1>
            <p class="text-center">
                Désireuse de donner aux jeunes les moyens de rêver et de réussir, notre association est le trait d’union entre les talents de demain et les acteurs qui façonnent le monde d’aujourd’hui. 
                En collaborant avec les écoles et universités pour inspirer sur le terrain, <span>les entreprises</span> pour offrir des opportunités concrètes d’immersion et avec les services publics pour mobiliser des ressources, nous créons ensemble une dynamique d’impact. 
                Votre engagement à nos côtés, c’est l’assurance de laisser une empreinte durable, de révéler des talents, et d’inspirer une génération à changer le monde. 
            </p>

            <p class="text-center font-weight-bold">Rejoignez-nous aujourd’hui pour contribuer, promouvoir
                et construire l’excellence de demain.
            </p>

            <h2 class="text-center m-5">Nos partenaires nous font confiance pour façonner les leaders de demain</h2>

            <h2 class="text-center mt-2"><i class="fas fa-building"></i>Entreprises du secteur privé</h2>
            <p class="mb-5">Accueil de stagiaires et sponsoring</p>

            @if($companies->isEmpty())
                <p>Recherche d’autres partenaires en cours</p>
            @else
                <div class="row justify-content-center">
                    @foreach($companies as $company)
                    <div class="col-md-4 d-flex">
                        <div class="p-4 mb-5 border rounded shadow-sm flex-fill d-flex flex-column">
                            <h3><i class="fas fa-handshake"></i>{{ $company->name }}</h3>
                            <p class="text-responsive">{{ $company->description }}</p>     
                        </div>
                    </div>
                    @endforeach
                
                </div>
            @endif
        </div>
    </section>
    @include('layouts.footer')
@endsection