@extends('layouts.app')
@section('title', config('meta.etablissements.title'))
@section('description', config('meta.etablissements.description'))

@section('content')
    @include('layouts.header')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Nos partenaires', 'url' => route('etablissements.index')]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
<section class="page-content py-5">
<div class="container py-5">
    <h1 class="text-center mb-4">Nos partenaires</h1>

    <p class="text-center">
        Désireuse de donner aux jeunes les moyens de rêver et de réussir, notre association est le trait d’union entre les talents de demain et les acteurs qui façonnent le monde d’aujourd’hui. 
        En collaborant avec les écoles et universités pour inspirer sur le terrain, les entreprises pour offrir des opportunités concrètes d’immersion et avec les services publics pour mobiliser des ressources, nous créons ensemble une dynamique d’impact. 
        Votre engagement à nos côtés, c’est l’assurance de laisser une empreinte durable, de révéler des talents, et d’inspirer une génération à changer le monde. 
    </p>

    <p class="text-center font-weight-bold">Rejoignez-nous aujourd’hui pour contribuer, promouvoir
         et construire l’excellence de demain.
    </p>

    <h2 class="text-center m-5">Nos partenaires nous font confiance pour façonner les leaders de demain</h2>

    @if($institutionPartners->isEmpty())
        <p class="text-center text-muted">Aucun établissement partenaire pour le moment.</p>
    @else
            <div class="row mt-4">
            @foreach($institutionPartners->groupBy('category') as $category => $partners)
        <!-- Section par catégorie -->
        <div class="col-12 mb-4">
            <h2 class="text-center mt-2"><i class="{{ $partners->first()->icon }}"></i> {{ $category }}</h2>
            @if(isset($categorySubtitles[$category]))
                <p class="text-center">{{ $categorySubtitles[$category] }}</p>
            @endif
            <div class="row justify-content-center">
                @foreach($partners as $partner)
                    <div class="col-md-6 mt-4">
                        <div class="p-4 border rounded shadow-sm">
                            <h3><i class="fas fa-handshake"></i> {{ $partner->name }}</h3>
                            <p>{{ $partner->description }}</p>
                            @if($partner->additional_info)
                                <ul>
                                    @foreach($partner->additional_info as $info)
                                        <li>{!! $info !!}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach

        </div>
    @endif
</div>
</section>


@include('layouts.footer')
@endsection