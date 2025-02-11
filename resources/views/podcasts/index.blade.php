@php
    $defaultBanner = '/image/banner.webp';
    $bannerImage = '/image/programmes-banner.jpg'; // Image spécifique à la page

    if (!file_exists(public_path($bannerImage))) {
        $bannerImage = $defaultBanner;
    }
@endphp
@extends('layouts.app')

@section('title', config('meta.podcasts.title'))
@section('description', config('meta.podcasts.description'))

@section('content')
@include('layouts.header')
@include('layouts.banner')

@php
    $breadcrumbs = [
        ['name' => 'Émission podcast', 'url' => route('podcasts.index')]
    ];
@endphp

@include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])

<div class="container py-5 d-flex flex-column min-vh-100">
    <h1 class="text-center fw-bold mb-4"><i class="fas fa-microphone"></i> Émission podcast</h1>

    <!-- FILTRES PAR CATÉGORIE -->
    <div class="text-center mb-4">
        <a href="{{ route('podcasts.index') }}#podcasts-section" class="btn btn-outline-dark mx-1 fw-bold border-2 mx-1 px-3 py-2 {{ request('category') ? '' : 'active' }}">
            Tous
        </a>

        @foreach($categories as $category)
            <a href="{{ route('podcasts.index', ['category' => $category]) }} #podcasts-section"  class="btn btn-color btn-primary border-2 mx-1 px-3 py-2 fw-bold {{ request('category') == $category ? 'active' : '' }}">
                {{ ucfirst($category) }}
            </a>
        @endforeach
    </div>

    @if ($podcasts->isEmpty())
        <p class="text-center text-muted">Aucun podcast disponible pour le moment.</p>
    @else
        <div class="row">
            @foreach ($podcasts as $podcast)
                <div class="col-md-6 mb-4">
                    <div id="podcasts-section" class="podcast-card d-flex align-items-start p-3 rounded shadow-sm">
                        <img src="{{ asset('storage/' . $podcast->image) }}" alt="{{ $podcast->name }}" class="podcast-card-image rounded">
                        <div class="ms-3">
                            <h2 class="h5 fw-bold">{{ $podcast->name }}</h2>
                            <p class="text-muted small mb-2">
                                {{ $podcast->created_at->format('d M, Y') }}
                            </p>
                            <p>{{ $podcast->category }}</p>
                            <p>{{ Str::limit($podcast->description, 150) }}</p>
                            <a href="{{ route('podcasts.show', $podcast->slug) }}" class="btn btn-outline-primary btn-sm">
                                <i class="fas fa-play"></i> Écouter le Podcast
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $podcasts->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

@include('layouts.footer')
@endsection