@extends('layouts.app')

@section('content')
@php $load_tinymce = true; @endphp
<div class="container p-5">
    <h2 class="my-4">✏️ Modifier l'Article</h2>
    <div class="mb-3">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            <i class="fas fa-backward"></i> Retour au tableau de bord
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.articles.update', $article->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Titre</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $article->title }}" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3">{{ $article->description }}</textarea>
        </div>
        
        <div class="mb-3">
            <label for="type" class="form-label">Type d'Article</label>
            <input class="form-control" id="type" name="type" required>
        </div>

        <div class="mb-3">
            <label for="text" class="form-label">Contenu</label>
            <textarea class="form-control editor" id="text" name="text" rows="8" required>{{ $article->text }}</textarea>
        </div>

        <div class="mb-3">
            <label for="img_banner" class="form-label">Image de l'Article</label>
            <input type="file" class="form-control" id="img_banner" name="img_banner">
        </div>

        <!-- <i class="fas fa-camera"></i> Gestion de la Galerie -->
        <h3 class="mt-4"><i class="fas fa-camera"></i> Galerie de l'Article</h3>
        <div class="mb-3">
            <input type="file" id="gallery-upload" name="gallery[]" multiple>
        </div>

        <div class="row">
            @foreach($article->media as $media)
                <div class="col-md-3">
                    <div class="gallery-item position-relative">
                        <img src="{{ asset('storage/' . $media->file_name) }}" class="img-fluid rounded shadow-sm">
                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 delete-media" data-id="{{ $media->id }}">🗑️</button>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Bouton de soumission -->
        <div class="text-center mt-4">
            <button type="submit" class="btn btn-success">💾 Mettre à Jour</button>
        </div>

    </form>

</div>
@endsection

