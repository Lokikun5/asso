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


@section('content')
@include('layouts.header')
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
<section class="py-5 bg-dark text-white">
    <div class="container d-flex flex-wrap align-items-center">
        <div class="col-md-6">
            <h1 class="display-5 fw-bold">{{ $podcast->name }}</h1>
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
                    <a href="#" id="share-facebook" class="btn btn-primary me-2 mb-2" target="_blank">
                        <i class="fab fa-facebook-f"></i> Facebook
                    </a>
                    <a href="#" id="share-linkedin" class="btn btn-info" target="_blank">
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
</section>

@include('layouts.footer')
@section('extra-js')
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let shareBtn = document.getElementById("share-btn");
        let shareButtons = document.getElementById("social-share-buttons");

        if (!shareBtn || !shareButtons) {
            console.error("❌ Bouton de partage non trouvé !");
            return;
        }

        // Récupération des informations du podcast
        let podcastUrl = encodeURIComponent(window.location.href); // ✅ Récupération correcte de l'URL
        let podcastTitle = encodeURIComponent("{{ $podcast->name }}");
        let podcastDescription = encodeURIComponent("{{ $podcast->description }}");
        let podcastImage = encodeURIComponent("{{ asset('storage/' . $podcast->image) }}");

        // URLs de partage avec fallback si Open Graph ne fonctionne pas
        let facebookUrl = `https://www.facebook.com/sharer/sharer.php?u=${podcastUrl}`;
        let linkedinUrl = `https://www.linkedin.com/shareArticle?mini=true&url=${podcastUrl}&title=${podcastTitle}&summary=${podcastDescription}&source={{ config('app.name') }}`;

        // Ajouter les liens aux boutons
        document.getElementById("share-facebook").setAttribute("href", facebookUrl);
        document.getElementById("share-linkedin").setAttribute("href", linkedinUrl);

        // Afficher les boutons de partage
        shareBtn.addEventListener("click", function() {
            shareButtons.classList.toggle("d-none");
        });

        console.log("✅ Partage Facebook : ", facebookUrl);
        console.log("✅ Partage LinkedIn : ", linkedinUrl);
    });
</script>
@endsection