@extends('layouts.app')

@section('title', $podcast->name)
@section('description', $podcast->description)
@section('extra-meta')
    <meta property="og:title" content="{{ $podcast->name }}">
    <meta property="og:description" content="{{ $podcast->description }}">
    <meta property="og:image" content="{{ asset('storage/' . $podcast->image) }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="article">
@endsection

{{-- ✅ Chargement conditionnel du CSS Lightbox2 --}}
@section('extra-css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css">
@endsection

@section('content')

<div class="mt-3">
    @php
        $breadcrumbs = [
            ['name' => 'Podcast', 'url' => route('podcasts.index')],
            ['name' => $podcast->name, 'url' => route('podcasts.show', $podcast->slug)]
        ];
    @endphp

    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
</div>

<!-- Section Hero -->
<section class="py-5 px-5 bg-dark text-white">
    <div class="container row align-items-center">
        <div class="col-md-6">
            <h1 class="display-5c fw-bold">{{ $podcast->name }}</h1>
            <p>{{ $podcast->category }}</p>
            <p class="mb-3">
                Publié le {{ $podcast->created_at->format('d M, Y') }}
            </p>
            @if (Storage::disk('public')->exists($podcast->file))
                <div class="mb-4">
                    <audio controls class="w-100">
                        <source src="{{ asset('storage/' . $podcast->file) }}" type="audio/mpeg">
                        Votre navigateur ne supporte pas l'élément audio.
                    </audio>
                </div>
            @else
                <p class="text-danger">Fichier non disponible.</p>
            @endif
            <div class="podcast-buttons">
                <a href="{{ asset('storage/' . $podcast->file) }}" class="btn btn-outline-secondary btn-lg me-2">
                    <i class="fas fa-play"></i> Écouter
                </a>
                <button id="share-btn" class="btn btn-secondary btn-lg">
                    <i class="fas fa-share-alt"></i> Partager
                </button>

                <div id="social-share-buttons" class="d-none mt-3">
                    <a href="#" id="share-facebook" class="btn social-btn facebook-btn me-2 mb-2" target="_blank">
                        <i class="fab fa-facebook-f"></i>Facebook
                    </a>
                    <a href="#" id="share-linkedin" class="btn social-btn linkedin-btn me-2 mb-2" target="_blank">
                        <i class="fab fa-linkedin-in"></i> LinkedIn
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-6 text-center">
            <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="img-fluid rounded shadow">
        </div>
    </div>
</section>

<!-- Contenu du podcast -->
<section class="container page-content">
    <h2 class="mb-4">À propos de ce podcast</h2>
    <p>{{ $podcast->page_content }}</p>

    <!-- Galerie associée -->
    @if($podcast->media->count())
        <h2 class="mt-5 text-center fw-bold"><i class="fas fa-images"></i> Galerie du Podcast</h2>
        <p class="text-muted text-center">Découvrez les images associées à ce podcast.</p>

        <!-- Grid d'images avec Lightbox -->
        <div class="row justify-content-center g-3 mt-3">
            @foreach($podcast->media as $media)
                <div class="col-md-4 col-sm-6">
                    <a href="{{ asset('storage/' . $media->file_name) }}" data-lightbox="podcast-gallery" data-title="{{ $media->name }}">
                        <img 
                            src="{{ asset('storage/' . $media->file_name) }}" 
                            class="img-fluid rounded shadow-sm" 
                            alt="{{ $media->name }}"
                            style="width: 100%; height: 250px; object-fit: cover;">
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</section>

{{-- ✅ Chargement conditionnel du JS Lightbox2 et Bootstrap Carousel --}}
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

        let shareBtn = document.getElementById("share-btn");
        let shareButtons = document.getElementById("social-share-buttons");

        if (!shareBtn || !shareButtons) {
            console.error("❌ Bouton de partage non trouvé !");
            return;
        }

        let podcastUrl = encodeURIComponent(window.location.href);
        let podcastTitle = encodeURIComponent("{{ $podcast->name }}");
        let podcastDescription = encodeURIComponent("{{ $podcast->description }}");

        let facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${podcastUrl}`;
        let linkedinUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${podcastUrl}&title=${podcastTitle}&summary=${podcastDescription}`;

        document.getElementById("share-facebook").setAttribute("href", facebookUrl);
        document.getElementById("share-linkedin").setAttribute("href", linkedinUrl);

        shareBtn.addEventListener("click", function() {
            shareButtons.classList.toggle("d-none");
        });
    });
</script>
@endsection