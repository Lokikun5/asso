@extends('layouts.app')

@section('title', $article->title . ' - Découvrez notre article complète')
@section('description', $article->description)
@section('canonical', Request::url())

{{-- ✅ Chargement conditionnel du CSS Lightbox2 --}}
@section('extra-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection

@section('content')
@include('layouts.header')

@php
    $breadcrumbs = [
        ['name' => 'Articles', 'url' => route('articles.index')],
        ['name' => $article->title, 'url' => route('articles.show', $article->id)]
    ];
@endphp

<!-- Breadcrumbs -->
<div class="mt-4">
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
</div>

<div class="container py-5">
    <!-- Titre de l'article -->
    <div class="text-center mb-5">
        <h1 class="fw-bold display-5">{{ $article->title }}</h1>
        <p>{{ $article->created_at->format('d/m/Y') }}</p>
        <p class="text-muted">{{ $article->description }}</p>
    </div>

    <!-- Image principale -->
    <div class="text-center mb-5">
        <img 
            src="{{ asset('storage/' . $article->img_banner) }}" 
            class="img-fluid rounded shadow-lg" 
            alt="{{ $article->title }}"
            style="max-height: 500px; object-fit: cover;">
    </div>

    <!-- Contenu -->
    <div class="content-section">
        {!! $article->text !!}
    </div>
  

    <!-- Galerie associée -->
    @if($article->media->count())
    <h2 class="mt-5 text-center fw-bold"><i class="fas fa-camera"></i> Galerie</h2>
    <p class="text-muted text-center">Découvrez les photos associées à cet article.</p>

    <!-- Bouton d'ouverture du carousel -->
    <div class="text-center my-4">
        <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal" data-bs-target="#imageCarouselModal">
            📷 Voir en plein écran
        </button>
    </div>

    <!-- Grid d'images avec Lightbox -->
    <div class="row justify-content-center g-3 mt-3">
        @foreach($article->media as $index => $media)
            <div class="col-md-4 col-sm-6">
                <a href="{{ asset('storage/' . $media->file_name) }}" data-lightbox="gallery" data-title="{{ $media->name }}">
                    <img 
                        src="{{ asset('storage/' . $media->file_name) }}" 
                        class="img-fluid rounded shadow-sm" 
                        alt="{{ $media->name }}"
                        style="height: 200px; object-fit: cover; width: 100%;">
                </a>
            </div>
        @endforeach
    </div>

    <!-- Modal Bootstrap pour le Carousel -->
    <div class="modal fade" id="imageCarouselModal" tabindex="-1" aria-labelledby="carouselLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="carouselLabel">Galerie d'images</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="galleryCarousel" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach($article->media as $index => $media)
                                <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                                    <img src="{{ asset('storage/' . $media->file_name) }}" class="d-block w-100" alt="{{ $media->name }}" style="max-height: 500px; object-fit: cover;">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#galleryCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Précédent</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#galleryCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Suivant</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif


    <!-- Bouton de retour -->
    <div class="text-center mt-5">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-lg px-5">
            <i class="fas fa-backward"></i> Retour aux articles
        </a>
    </div>
</div>

@include('layouts.footer')
{{-- ✅ Chargement conditionnel du JS Lightbox2 --}}
@section('extra-js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox-plus-jquery.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (typeof lightbox !== 'undefined' && typeof lightbox.option === 'function') {
                lightbox.option({
                    'resizeDuration': 200,
                    'wrapAround': true,
                    'albumLabel': "Image %1 sur %2"
                });
                console.log("✅ Lightbox2 a bien été chargé !");
            } else {
                console.error("❌ Lightbox2 ne s'est pas chargé correctement !");
            }
        });
    </script>
@endsection