@extends('layouts.app')
@section('title', $article->title)
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
    <div class="mt-5">
        @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    </div>

<div class="container py-5">
    <!-- Titre de l'article -->
    <h1 class="mb-4 text-center fw-bold">{{ $article->title }}</h1>

    <!-- Image principale de l'article -->
    <div class="text-center mb-4">
        <img src="{{ asset('storage/' . $article->img_banner) }}" class="img-fluid rounded shadow-lg" alt="{{ $article->title }}">
    </div>

    <!-- Contenu de l'article -->
    <div class="mx-auto" style="max-width: 800px;">
        <p class="lead text-justify">{{ $article->text }}</p>
    </div>

    <!-- Galerie associée -->
    @if($article->media->count())
    <h2 class="mt-5 text-center">📸 Galerie</h2>
    <div class="row justify-content-center">
        @foreach($article->media as $media)
        <div class="col-md-3 col-sm-6 mb-3">
            <a href="{{ asset('storage/' . $media->file_name) }}" data-lightbox="gallery" data-title="{{ $media->name }}">
                <img src="{{ asset('storage/' . $media->file_name) }}" class="img-fluid rounded shadow-sm" alt="{{ $media->name }}">
            </a>
        </div>
        @endforeach
    </div>
    @endif

    <!-- Bouton de retour -->
    <div class="text-center mt-5">
        <a href="{{ route('articles.index') }}" class="btn btn-secondary btn-lg px-4">⏪ Retour aux articles</a>
    </div>
</div>

@include('layouts.footer')

@endsection