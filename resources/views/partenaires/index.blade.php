@php
    $defaultBanner = '/image/banner.webp';
    $bannerImage = '/image/partner-banner.webp'; // Image spécifique à la page

    if (!file_exists(public_path($bannerImage))) {
        $bannerImage = $defaultBanner;
    }
@endphp
@extends('layouts.app')
@section('title', config('meta.partenaires.title'))
@section('description', config('meta.partenaires.description'))

@section('content')
    @include('layouts.banner')

    @php
        $breadcrumbs = [
            ['name' => 'Nos formateurs et bénévoles', 'url' => route('partenaires')]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

    <section class="page-content py-5">
        <div class="container">
            <h1 class="text-center mb-4">Nos formateurs et bénévoles</h1>
            
            <div class="row mt-4">
            @foreach($partners as $partner)
                <div class="col-md-4 mb-4">
                    <div class="partner-card">
                    <!-- Image du partenaire -->
                    <img 
                        src="{{ asset($partner->profile_picture) }}" 
                        alt="{{ $partner->first_name }}" 
                        class="partner-card-image"
                    >
                
                    <!-- Overlay affiché au survol / clic -->
                    <div class="partner-card-overlay">
                        <h3><i class="fas fa-chalkboard-teacher"></i> {{ $partner->first_name }} {{ $partner->last_name }}</h3>
                        <p class="des-colors">{{ Str::limit($partner->description, 100) }}</p>
                            <a href="{{ route('partenaire.show', $partner->slug) }}" class="btn btn-color btn-primary marginbot">
                                Découvrir le partenaire
                            </a>
                            <a href="{{ $partner->partner_link }}" class="btn btn-color2" target="_blank">
                                Linkedin
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
@endsection
