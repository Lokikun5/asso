@extends('layouts.app')
@section('title', config('meta.article.title'))
@section('description', config('meta.article.description'))

@section('content')
@include('layouts.header')

@php
        $breadcrumbs = [
            ['name' => 'Articles', 'url' => route('articles.index')]
        ];
    @endphp
    <div class="mt-5">
    @include('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
    </div>
<div class="container py-5">
    <h1 class="text-center mb-4">Tous les Articles</h1>
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-4 mb-4">
            <div class="card h-100 d-flex flex-column">
                <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                <div class="card-body d-flex flex-column">
                    <p>{{ $article->type }}</p>
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                    <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-color btn-primary mt-auto">Lire la suite</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')
@endsection
