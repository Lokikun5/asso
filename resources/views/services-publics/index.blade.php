@php
    $defaultBanner = '/image/banner.webp';
    $bannerImage = '/image/priv-pub-banner.webp'; // Image spécifique à la page

    if (!file_exists(public_path($bannerImage))) {
        $bannerImage = $defaultBanner;
    }
@endphp
@extends('layouts.app')
@section('title', config('meta.services-publics.title'))
@section('description', config('meta.services-publics.description'))

@section('content')
    @include('layouts.banner')
    @php
        $breadcrumbs = [
            ['name' => 'Secteur public', 'url' => route('sector.utilities')]
        ];
    @endphp
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    <section class="page-content py-5">
        <div class="container">
            <h1 class="mb-4">Nos partenaires - Secteur public</h1>
            <p class="text-responsive mt-5 mb-5">
                Désireuse de donner aux jeunes les moyens de rêver et de réussir, notre association est le trait d’union entre les talents de demain et les acteurs qui façonnent le monde d’aujourd’hui.
            </p>   
            <p class="text-responsive"> 
                En collaborant avec les écoles et universités pour inspirer sur le terrain, les entreprises pour offrir des opportunités concrètes d’immersion et avec les <span>services publics</span> pour mobiliser des ressources, nous créons ensemble une dynamique d’impact.
            </p> 
            <p class="text-responsive"> 
                Votre engagement à nos côtés, c’est l’assurance de laisser une empreinte durable, de révéler des talents, et d’inspirer une génération à changer le monde. 
            </p>
            <p class="text-center font-weight-bold">Rejoignez-nous aujourd’hui pour contribuer, promouvoir
                et construire l’excellence de demain.
            </p>

            <h2 class="text-center m-5">Nos partenaires nous font confiance pour façonner les leaders de demain</h2>
            <h2 class="text-center mt-2"><i class="fas fa-landmark"></i> Entreprises du secteur privé</h2>
            <p class="mb-5">Soutien pour accéder à des subventions</p>

            @if($utilities->isEmpty())
                <p>Recherche d’autres partenaires en cours</p>
            @else
                <div class="row justify-content-center">
                    @foreach($utilities as $utilitie)
                    <div class="col-md-4 d-flex">
                        <div class="p-4 mb-5 border rounded shadow-sm flex-fill d-flex flex-column">
                            <h3> <i class="fas fa-handshake"></i> {{ $utilitie->name }}</h3>
                            <p class="text-responsive">{{ $utilitie->description }}</p>     
                        </div>
                    </div>
                    @endforeach
                
                </div>
            @endif
            <p class="fst-italic">Recherche d’autres partenaires en cours</p>
        </div>
    </section>
@endsection