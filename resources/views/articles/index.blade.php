@extends('layouts.app')
@section('title', config('meta.article.title'))
@section('description', config('meta.article.description'))

@section('content')
@php
        $breadcrumbs = [
            ['name' => 'Articles', 'url' => route('articles.index')]
        ];
    @endphp
    <div class="mt-4">
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    </div>
<div class="container py-5">
    <h1 class="text-center fw-bold mb-4">Tous les articles</h1>

    <!-- FILTRES -->
    <div class="text-center mb-4">
        <a href="{{ route('articles.index') }}" class="btn btn-outline-dark mx-1 fw-bold border-2 mx-1 px-3 py-2 {{ request('type') ? '' : 'active' }}">
            Tous
        </a>

        @foreach($types as $type)
            <a href="{{ route('articles.index', ['type' => $type]) }}" class="btn btn-color btn-primary border-2 mx-1 px-3 py-2 fw-bold {{ request('type') == $type ? 'active' : '' }}">
                {{ ucfirst($type) }}
            </a>
        @endforeach
    </div>

    <!-- AFFICHAGE DES ARTICLES -->
    <div class="row">
        @forelse($articles as $article)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm border-0 rounded">
                    <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top rounded-top" alt="{{ $article->title }}">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $article->title }}</h5>
                        <p class="text-muted small">
                            <i class="far fa-calendar-alt"></i> {{ $article->created_at->format('d M Y') }}
                        </p>
                        <p>{{ $article->type }}</p>
                        <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                        <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-color btn-primary mt-auto">Lire la suite</a>
                    </div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">Aucun article trouvé.</p>
        @endforelse
    </div>
</div>
@endsection
