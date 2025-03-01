@php
    $defaultBanner = '/image/banner.webp';
    $bannerImage = '/image/programmes-banner.jpg'; // Image spécifique à la page

    if (!file_exists(public_path($bannerImage))) {
        $bannerImage = $defaultBanner;
    }
@endphp
@extends('layouts.app')

@section('title', $partner->first_name . ' ' . $partner->last_name)
@section('description', $partner->first_name . ' ' . $partner->description)
@section('content')
@include('layouts.banner')

@php
    $breadcrumbs = [
        ['name' => 'Nos Partenaires', 'url' => route('partenaires')],
        ['name' => $partner->first_name . ' ' . $partner->last_name, 'url' => route('partenaire.show', $partner->slug)]
    ];
@endphp

<!-- Breadcrumbs -->
<div class="mt-1">
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
</div>

<div class="container py-5">
    <!-- Titre du partenaire -->
    <div class="text-center mb-5">
        <h1 class="display-5c fw-bold">{{ $partner->first_name }} {{ $partner->last_name }}</h1>
        <p class="text-muted">{{ $partner->description }}</p>
    </div>
    <div class="text-center mb-3">
        @foreach($partner->categories as $category)
            <span class="badge badge-custom mb-5">{{ $category->name }}</span>
        @endforeach
    </div>


    <!-- Image du partenaire -->
    <div class="text-center mb-5">
        <img 
            src="{{ $partner->profile_picture }}" 
            alt="{{ $partner->first_name }}" 
            class="img-fluid rounded-circle shadow-lg partner-img" 
            >
    </div>

    <!-- Contenu détaillé -->
    
        <div class="content-section">
            {!! $partner->text !!}
        </div>
   <!-- Lien vers le site du partenaire -->
   @if ($partner->partner_link)
        <div class="text-center mb-5">
            <a href="{{ $partner->partner_link }}" target="_blank" class="btn btn-outline-success btn-lg px-5">
                <i class="fas fa-globe"></i> Suivre sur LinkedIn
            </a>
        </div>
    @endif


    <!-- Bouton de retour -->
    <div class="text-center mt-5">
        <a href="{{ route('partenaires') }}" class="btn btn-outline-secondary btn-lg px-5">
            <i class="fas fa-backward"></i> Retour aux partenaires
        </a>
    </div>
</div>
@endsection