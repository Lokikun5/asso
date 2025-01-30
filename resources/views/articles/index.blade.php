@extends('layouts.app')

@section('content')
@include('layouts.header')
<div class="container py-5">
    <h1 class="text-center mb-4">Tous les Articles</h1>
    <div class="row">
        @foreach($articles as $article)
        <div class="col-md-4 mb-4">
            <div class="card">
                <img src="{{ asset('storage/' . $article->img_banner) }}" class="card-img-top" alt="{{ $article->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $article->title }}</h5>
                    <p class="card-text">{{ Str::limit($article->description, 100) }}</p>
                    <a href="{{ route('articles.show', $article->slug) }}" class="btn btn-primary">Lire la suite</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@include('layouts.footer')
@endsection
