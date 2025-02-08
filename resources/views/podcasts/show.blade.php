@extends('layouts.app')

@section('title', $podcast->name)
@section('description', $podcast->description)

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
                <button class="btn btn-secondary btn-lg">
                    <i class="fas fa-share-alt"></i> Partager
                </button>
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
@endsection