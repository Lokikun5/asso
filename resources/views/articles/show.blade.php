@extends('layouts.app')

@section('title', $article->title . ' - Découvrez notre article complète')
@section('description', $article->description)
@section('canonical', Request::url())

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
        <div class="row justify-content-center g-3 mt-3">
            @foreach($article->media as $media)
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
    @endif

    <!-- Bouton de retour -->
    <div class="text-center mt-5">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-secondary btn-lg px-5">
            <i class="fas fa-backward"></i> Retour aux articles
        </a>
    </div>
</div>

@include('layouts.footer')
@endsection